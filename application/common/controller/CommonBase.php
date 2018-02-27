<?php
namespace app\common\controller;

use think\Controller;

class CommonBase extends Controller
{
	protected $error    = '';   // 错误原因
	protected $code     = '';   // 空表示成功
	private   $response = '';   // 返回数据

	/**
	 * 接口返回格式
	 * @param  string $data [description]
	 * @return [type]       [description]
	 */
	protected function jsonReturn( $data = '' )
	{
		$message   = '';

		if ( $this->error ) {

			$isSuccess = 0;

			$message   = $this->error;

			$data      = '';

		} else {

			$isSuccess = 1;

		}

		$this->response = ['isSuccess' => $isSuccess, 'code' => $this->code, 'message' => $message, 'data' => $data];

		return json( $this->response );
	}

	/**
	 * 设置错误
	 * @param [type] $error [description]
	 * @param string $code  [description]
	 */
	protected function setError($error, $code = '')
	{
		$this->error = $error;

		$this->setCode( $code );

		return $this; 
	}

	/**
	 * 设置错误code
	 * @param [type] $code [description]
	 */
	protected function setCode($code) 
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * 销毁, 记录
	 */
	public function __destruct()
	{
		// // 日志记录
		// trace( 'request: '.$this->request->url() );
		// trace( 'params: '.var_export( $this->request->param(), true ) );
		// // if ( $this->error || $this->code ) trace( 'response: '.json_encode( $this->response, JSON_UNESCAPED_UNICODE ) );
		// trace( 'response: '.json_encode( $this->response, JSON_UNESCAPED_UNICODE ) );
		
		// $run_time = microtime(true) - THINK_START_TIME;
		// trace( 'run_time '.$run_time );
	}
}