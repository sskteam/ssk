<?php 
namespace app\admin\logic;

use app\common\logic\CommonBaseLogic;
use app\common\model\Admin;

class AdminLogic extends CommonBaseLogic
{

	/**
	 * 1. 验证用户
	 * 2. 添加session缓存用户信息
	 * @param  array $data 服务器登录返回数据
	 * @return array       返回小程序客户端数据
	 */
	public function doLogin( $post )
	{
		$adminModel = model( 'admin' )->findOne( $post['name'], $post['password'] ); // 返回 admin对象 或者 false

		if ( !$adminModel ) return $this->setError( '登录名密码不正确' );

		// 设置session, 根据用户id
		set_admin_session( $adminModel->getData() );
	}

	/**
	 * 新增admin用户
	 * @return [type] [description]
	 */
	public function doAdd( $post )
	{
		$salt = build_admin_salt();

		$post['password']    = md5( $post['password'].$salt );

		$post['salt']        = $salt;

		$post['create_time'] = get_date();

		$post['update_time'] = get_date();

		if ( !model( 'admin' )->addOne( $post ) ) $this->setError( '新增账号失败' );
	}

	/**
	 * 更新admin用户
	 * @return [type] [description]
	 */
	public function doEdit( $post )
	{
		$adminModel = model( 'admin' )->findOneById( $post['id'] );

		if ( !$adminModel ) return $this->setError( '管理员不存在' );

		$salt = $adminModel->salt;

		$adminModel->password= md5( $post['password'].$salt );

		$adminModel->update_time = get_date();

		if ( !$adminModel->save() ) $this->setError( '修改账号密码失败' );
	}

	/**
	 * 管理员列表
	 * @return [type] [description]
	 */
	public function getList()
	{
		return model( 'admin' )->findAll();
	}
}