<?php 
namespace app\common\model;

use think\Model;

class Admin extends Model
{
	/**
	 * 查找一条admin数据
	 * @param  [type] $mobile [description]
	 * @return [type]         [description]
	 */
	public static function findOne( $name, $password )
	{
		$adminModel = self::where( ['mobile' => $mobile, 'mobile_validated' => 1] )->find();
	}

	/**
	 * 查找批量admin数据
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public static function findAll( $where )
	{

	}

}