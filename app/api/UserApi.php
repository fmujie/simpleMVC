<?php

namespace api;
use request\httpRequest;
use response\httpResponse;

class UserApi
{

	protected $response;
	protected $request;
	private $checkResult;
	private $requestMethod;

	function __construct($requestMethod = "GET")
	{
		$this->response = new httpResponse();
		$this->request = new httpRequest($requestMethod);
		$this->checkResult = $this->request->checkMethod();
		if(!$this->checkResult)
		{
			// die("请求方式不允许");
			$this->badRequestMethod();
		} //else {
		// 	echo "请求方法被允许";
		// }
	}

	public function getAllUserLogInfo($data)
	{
		// $name = $_POST['name'];
		$name = $this->request->input('name');
		// echo $name;
		// $arr = [];
		// $arr = $name;
		return $this->response->response(1, 'Success', $name);
		// return $this->response->response(1, 'Success', $data);
	}

	protected function badRequestMethod()
	{
		return $this->response->response(0, 'Method Not Allowed', []);
	}
}