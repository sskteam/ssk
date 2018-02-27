<?php 
namespace app\admin\controller;

class Admin extends AdminBase
{

	/**
	 * 初始化控制器 5.1 => initialize  5.0 => _initialize
	 * @return [type] [description]
	 */
	public function initialize() 
	{

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
    public function login( $username, $password, $token )
    {
        
    }

    public function lists()
    {

    }

    public function add()
    {

    }

    public function info()
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
