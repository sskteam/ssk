<?php 
namespace app\common\model;

use think\Model;

class Admin extends Model
{

	// protected $filed = [
	// 	'id',
	// 	'name',
	// 	'password',
	// 	'salt',
	// 	'create_time',
	// 	'update_time',
	// 	'last_login',
	// 	'ip',
	// ];

	/**
	 * 查找一条admin数据
	 * @param  [type] $mobile [description]
	 * @return [type]         [description]
	 */
	public function findOne( $name, $password )
	{

		$flag = false;

		$adminModel = $this->field( 'id, password, salt' )->where( 'name', $name )->find();

		if ( $adminModel ) {

			// 验证密码
			if ( md5( $password.$adminModel->salt) == $adminModel->password ) {

				// 验证用户名密码成功 1. 更新最新登录时间, 2. ip
				$adminModel->last_login = get_date();

				$adminModel->ip = get_server_info( 'REMOTE_ADDR' );

				$adminModel->save();

				$flag = $adminModel;

			}
		}  

		return $flag;
	}

	/**
	 * 通过id号查找一条admin数据
	 * @param  [type] $mobile [description]
	 * @return [type]         [description]
	 */
	public function findOneById( $id )
	{
		return $this->field( 'id, password, salt' )->where( 'id', $id )->find();
	}

	/**
	 * 查找批量admin数据
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public function findAll( $where )
	{
		return $this->order('id asc')->select();
	}

	/**
	 * 新增一个admin账号
	 */
	public function addOne( $post )
	{
		// id			int	
		// name			varchar
		// password		varchar
		// salt			mediumint	
		// create_time	datetime
		// update_time	datetime
		// last_login	datetime
		// ip			varchar

		return $this->allowField( true )->save( $post );

	}

}