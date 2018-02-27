<?php 
namespace app\admin\logic;

use app\common\logic\CommonBaseLogic;

class AdminLogic extends CommonBaseLogic
{
	/**
	 * 1. 用户使用短信登录
	 * 2. 验证用户是否已经注册
	 * 3. 更新用户access_token
	 * 4. 生成新的访问token
	 * 5. 添加cache缓存用户信息
	 * @param  array $data 服务器登录返回数据
	 * @return array       返回小程序客户端数据
	 */
	public static function doLogin( $post )
	{
		
		$exp_time = get_token_exp_time();  // 30 天有效期

		$mobile = $post['mobile'];
		
		// 保存在数据库中的token (access_token);
		$access_token = build_user_access_token();

		$tokenArr = ['mobile' => $mobile, 'exp_time' => $exp_time, 'secret' => APP_API_KEY, 'token' => $access_token];

		// 生成token
		$token = build_token( $tokenArr );

		// 查找用户
		$userModel = self::findUser( $mobile );

		if ( !$userModel ) return self::setError( '账号未注册' );

		// 更新用户信息
		$userModel->token      = $access_token;
		$userModel->last_login = time();
		$userModel->save();

		// 限制字段
		// $userModel->visible( ['exp_time', 'token'] );

		$userArray = $userModel->toArray();

		// 将数据保存到缓存中, 以后每次查询数据都在缓存中提取用户数据进行验证
		save_user_cache( $mobile, $userArray );

		$data = [];

		// 用户积分
		$data['pay_points'] = $userModel['pay_points'];  

		// 获取用户优惠券未使用未过期总数
		self::setUserId( $userModel['user_id'] );

		$data['coupon_count'] = self::getUserValideCouponNumber();

		// 获取用户取货二维码
		$data['qrcode_count'] = count( self::getOrderQrCode() );

		// 返回用户基本数据
		return ['mobile' => $mobile, 'exp_time' => $exp_time, 'token' => $token, 'data' => $data];
	}

	/**
	 * 用户注册
	 * @return [type] [description]
	 */
	public static function doRegister( $mobile )
	{
		// 生成token
		$access_token = build_user_access_token();

        //账户不存在 注册一个
		$insert['password']         = '';
		$insert['mobile']           = $mobile;
		$insert['mobile_validated'] = 1;
		$insert['openid']           = '';
		$insert['nickname']         = '';
		$insert['reg_time']         = time();
		$insert['last_login']       = time();
		$insert['oauth']            = 'app';   // app注册标识
		$insert['head_pic']         = '';
		$insert['sex']              = '';
		$insert['token']            = $access_token;
		$insert['session3rd']       = '';
		$insert['first_leader']     = 0;
        // 成为分销商条件  
        $distribut_condition = tpCache('distribut.condition'); 

        if ( $distribut_condition == 0 ) { // 直接成为分销商, 每个人都可以做分销     
			$insert['is_distribut'] = 1;
        }
        // halt($insert);
        $user = UserModel::create($insert);

        if ( !$user ) return self::setError( '注册用户失败' );

		// 将数据保存到缓存中, 以后每次查询数据都在缓存中提取用户数据进行验证
		save_user_cache( $mobile, $user );

		// 生成token
		$exp_time = get_token_exp_time();
		$tokenArr = ['mobile' => $mobile, 'exp_time' => $exp_time, 'secret' => APP_API_KEY, 'token' => $access_token];
		$token    = build_token( $tokenArr );

		return ['mobile' => $mobile, 'exp_time' => $exp_time, 'token' => $token];
	}




	/**
	 * 验证token
	 * @param  string $openId     
	 * @param  string $token      
	 * @param  string $session3rd 
	 * @return int    用户users表中的user_id
	 */
	public static function checkToken($mobile, $exp_time, $token)
	{

		// 1. 查看exp_time是否已过期 30天
		if ( (get_token_exp_time() - $exp_time) > APP_EXP_TIME ) return self::setError( '账号已过期, 请重新登录' );

		// 2. 获取用户数据表中的token (access_token)
		$userInfo = get_user_cache( $mobile );

		$userInfo = !$userInfo ? self::updateUserCache( $mobile ) : $userInfo;

		if ( !$userInfo ) return false;

		// 3. 验证token有效?
		$tokenArr = ['mobile' => $mobile, 'exp_time' => $exp_time, 'secret' => APP_API_KEY, 'token' => $userInfo['token']];

		if ( $token != build_token( $tokenArr ) ) {

			// del_user_cache( $mobile );
			return self::setError( 'token验证失败' );
		}

		return $userInfo['user_id'];
	}

	/**
	 * 更新token
	 * 超过登录1天, 则更新,否则不更新
	 */
	public static function refreshToken( $mobile, $exp_time, $token )
	{
		// 1. 获取用户数据表中的token (access_token)
		$userInfo = get_user_cache( $mobile );

		$userInfo = !$userInfo ? self::updateUserCache( $mobile ) : $userInfo;

		if ( !$userInfo ) return false;

		// 如果登录超过1天 24 * 3600 更新 token
		if ( (get_token_exp_time() - $exp_time) > APP_TOKEN_REFRESH_TIME ) {

			// 2. 保存在数据库中的token (access_token);
			$access_token = build_user_access_token();

			UserModel::where( 'mobile', $mobile )->update( ['token' => $access_token] );

			// 3. 更新cache中
			$userInfo['token'] = $access_token;

			save_user_cache( $mobile, $userInfo );

			// 4. 生成新的token, exp_time给app
			$exp_time = get_token_exp_time();

			$tokenArr = ['mobile' => $mobile, 'exp_time' => $exp_time, 'secret' => APP_API_KEY, 'token' => $access_token];

			$token = build_token( $tokenArr );
		}

		// 获取相关用户信息
		$data = [];

		// 用户积分
		$data['pay_points'] = $userInfo['pay_points'];  

		// 获取用户优惠券未使用未过期总数
		self::setUserId( $userInfo['user_id'] );

		$data['coupon_count'] = self::getUserValideCouponNumber();

		// 获取用户取货二维码
		$data['qrcode_count'] = count( self::getOrderQrCode() );

		return ['mobile' => $mobile, 'exp_time' => $exp_time, 'token' => $token, 'data' => $data];
	}

	/**
	 * 更新cache中的用户信息
	 * @return [type] [description]
	 */
	public static function updateUserCache( $mobile )
	{

		if ( !$userInfo = self::findUser( $mobile ) ) return self::setError( '更新用户cache数据失败, 未找到账户: mobile: '.$mobile );

		$userInfo = $userInfo->toArray();

		save_user_cache( $mobile, $userInfo );

		// 获取用户优惠券未使用未过期总数
		// $coupon_count = self::getUserValideCouponNumber();
		// $data['coupon_count'] = $coupon_count;
		
		return $userInfo;
	}
}