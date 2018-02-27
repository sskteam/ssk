<?php 
namespace app\admin\controller;

class Admin extends AdminBase
{

	private $adminLogic;

	/**
	 * 初始化控制器 5.1 => initialize  5.0 => _initialize
	 * @return [type] [description]
	 */
	public function initialize() 
	{
		$filter_action = ['login', 'index'];

		$request_action = strtolower( $this->request->action() );

		if ( !in_array( $request_action, $filter_action ) ) {

			if ( !get_admin_session() ) {

				$this->redirect( 'index/index' ); exit();
			}

		}

		$this->adminLogic = logic( 'adminLogic' );
	}

	public function index()
	{
		$this->redirect('login');
	}

	/**
	 * 管理员登录
	 * @param  string $username 用户名
	 * @param  string $password 用户密码
	 * @param  string $token    token, 系统生成
	 */
    public function login()
    {

    	if ( get_admin_session() ) return $this->redirect( 'index/index' );

    	if ( !$this->request->isPost() ) return $this->setError( '非法操作' )->jsonReturn();

    	$post = $this->request->param();

    	// 验证规则
	    $rule =   [
			'name'     => 'require',
			// 'name'     => 'require|token',
			'password' => 'require',
	    ];
	    
	    // 验证返回信息
	    $message  =   [
			'name.require'     => '用户名不得为空',
			'password.require' => '密码不得为空',
	    ];

		// 执行验证, 返回true则为通过 ,否则返回string ( message中设置的错误信息 )
	    $is_validate = $this->validate( $post, $rule, $message );

	    if ( true !== $is_validate ) return $this->setError( $is_validate )->jsonReturn();

	    // 登录验证用户密码
	    $this->adminLogic->doLogin( $post );

	    $error = $this->adminLogic->getError();

	    return $this->setError( $error )->jsonReturn();
    }

    /**
     * 管理员退出
     * @return [type] [description]
     */
    public function logout()
    {
    	del_admin_session();

    	return $this->jsonReturn();
    }

    public function lists()
    {

    	$admin_list = $this->adminLogic->getList();

    	return $this->jsonReturn( $admin_list );

    }

    public function add()
    {

    	if ( !$this->request->isPost() ) return $this->setError( '非法操作' )->jsonReturn();

    	$post = $this->request->param();

    	// 验证规则
	    $rule =   [
			'name'     => 'require|min:4|unique:admin',
			'password' => 'require|min:6',
	    ];
	    
	    // 验证返回信息
	    $message  =   [
			'name.require'     => '用户名不得为空',
			'name.min'		   => '用户名不得小于4位',
			'name.unique'	   => '用户名已存在',
			'password.require' => '密码不得为空',
			'password.min'	   => '密码不得小于6位'
	    ];

		// 执行验证, 返回true则为通过 ,否则返回string ( message中设置的错误信息 )
	    $is_validate = $this->validate( $post, $rule, $message );

	    if ( true !== $is_validate ) return $this->setError( $is_validate )->jsonReturn();

	    // 新增admin账号
	    $this->adminLogic->doAdd( $post );

	    $error = $this->adminLogic->getError();

	    return $this->setError( $error )->jsonReturn();

    }


    // public function info()
    // {

    // }

    /**
     * 账号密码更新
     * @return [type] [description]
     */
    public function edit()
    {
		if ( !$this->request->isPost() ) return $this->setError( '非法操作' )->jsonReturn();

    	$post = $this->request->param();

    	// 验证规则
	    $rule =   [
	    	'id'	   => 'require|number',
			'password' => 'require|min:6',
	    ];
	    
	    // 验证返回信息
	    $message  =   [
			'id.require'       => 'id不存在',
			'id.number'        => 'id必须是数字',
			'password.require' => '密码不得为空',
			'password.min'     => '密码不得小于6位'
	    ];

		// 执行验证, 返回true则为通过 ,否则返回string ( message中设置的错误信息 )
	    $is_validate = $this->validate( $post, $rule, $message );

	    if ( true !== $is_validate ) return $this->setError( $is_validate )->jsonReturn();

	    // 修改账号密码
	    $this->adminLogic->doEdit( $post );

	    $error = $this->adminLogic->getError();

	    return $this->setError( $error )->jsonReturn();
    }

    /**
     * 删除admin账号
     * @return [type] [description]
     */
    public function delete()
    {
    	if ( !$this->request->isPost() ) return $this->setError( '非法操作' )->jsonReturn();

    	// 验证规则
	    $rule =   [
	    	'id'	   => 'require|number'
	    ];
	    
	    // 验证返回信息
	    $message  =   [
			'id.require'       => 'id不存在',
			'id.number'        => 'id必须是数字',
	    ];

		// 执行验证, 返回true则为通过 ,否则返回string ( message中设置的错误信息 )
	    $is_validate = $this->validate( $post, $rule, $message );

	    if ( true !== $is_validate ) return $this->setError( $is_validate )->jsonReturn();


    }
}
