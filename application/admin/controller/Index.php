<?php 
namespace app\admin\controller;

class Index extends AdminBase
{
	/**
	 * vue 只有一个html 单页应用
	 * @return [type] [description]
	 */
    public function index()
    {
        return $this->fetch();
    }
}
