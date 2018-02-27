<?php 
namespace app\common\logic;

class CommonBaseLogic
{
	// 单例应用(自身对象)
	private static $baseLogic = '';

	// 错误信息
	protected $error = '';    // 错误信息
	protected $code  = '';    // 错误编码

	// 用户id和session信息 
	protected $userId = '';   // 用户id
    protected $sessionId = '';     // session_id
    
    // 分页配置
	protected $page = 1;
	protected $size = 10;

	public function __construct() 
	{
		$this->size = config( 'PAGESIZE' );
	}

	/**
	 * 单例应用
	 * @return [type] [description]
	 */
	public static function instance()
	{
		if ( !is_object(self::$baseLogic) || self::$baseLogic instanceof this ) self::$baseLogic = new self;
		return self::$baseLogic;
	}

	/**
	 * 静态魔术方法
	 * @param  [type] $method [description]
	 * @param  [type] $value  [description]
	 * @return [type]         [description]
	 */
	public static function __callStatic($method, $value)
	{
		self::instance();
		$name = lcfirst(substr($method, 3));
		if (substr($method, 0, 3) == 'set') self::$baseLogic->$name = $value[0];
		if (substr($method, 0, 3) == 'get') return self::$baseLogic->$name;
	}

	/**
	 * 魔术方法
	 * @param  [type] $method [description]
	 * @param  [type] $value  [description]
	 * @return [type]         [description]
	 */
	public function __call($method, $value)
	{
		$name = lcfirst(substr($method, 3));
		if (substr($method, 0, 3) == 'set') {
			$this->$name = $value[0];
			return $this;
		}
		if (substr($method, 0, 3) == 'get') return $this->$name;
	}

}