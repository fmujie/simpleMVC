<?php

namespace controller;
use model\UserModel;
use api\UserApi;
	
/**
 * 
 */
class UserController
{
	protected $userModel;
	protected $api;
	
	function __construct()
	{
		$this->userModel = new UserModel();
	}

	function getAllUserLogInfo()
	{
		$datas = $this->userModel->stAlUsLogIf();
		// var_dump(json_encode($datas));
		// if(is_array($datas))
		// {
		// 	echo 'arr';
		// }
		// var_dump($datas);
		return $datas;
		// return $this->response->response(200, 'Success', $datas);
		// echo json_encode($datas);
	}

	function getAllUserLogInfoApi()
	{

		$this->api = new UserApi("POST");
		$data = $this->getAllUserLogInfo();
		// var_dump($data);
		$this->api->getAllUserLogInfo($data);
	}
}