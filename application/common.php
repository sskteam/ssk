<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\Loader;

if ( !function_exists( 'get_server_info' ) ) 
{
	function get_server_info( $name = '' ) 
	{
		return request()->server( $name );
	}	
}

/**
 * 获得时间 (字符串 Y-m-d H:i:s)
 */
if ( !function_exists( 'get_date' ) )
{
	function get_date( $param = 'Y-m-d H:i:s', $time = '' )
	{
		$time = $time ? $time : time();

		return date( $param, $time );
	}
}

/**
 * 实例化逻辑类 格式：[模块/]逻辑
 * @param string    $name 资源地址
 * @param string    $layer 控制层名称
 * @param bool      $appendSuffix 是否添加类名后缀
 * @return \think\Controller
 */
if ( !function_exists( 'logic' ) ) 
{
    function logic( $name )
    {
        return model( $name, 'logic' );
    }
}

/**
 * 设置session_admin
 */
if ( !function_exists( 'set_admin_session' ) ) 
{
    function set_admin_session( $value )
    {
        return session( 'admin_info', $value, 'ssk_admin' );
    }
}

/**
 * 设置session_admin
 */
if ( !function_exists( 'get_admin_session' ) ) 
{
    function get_admin_session()
    {
        return session( 'admin_info', '', 'ssk_admin' );
    }
}

/**
 * 删除session_admin
 */
if ( !function_exists( 'del_admin_session' ) ) 
{
    function del_admin_session()
    {
        return session( 'admin_info', null, 'ssk_admin' );
    }
}

/**
 * 删除session_admin
 */
if ( !function_exists( 'build_admin_salt' ) ) 
{
    function build_admin_salt()
    {
        return substr( uniqid(), 0, 8 );
    }
}