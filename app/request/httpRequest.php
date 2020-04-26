<?php

namespace request;

class httpRequest
{
	protected $requestMthod;

	function __construct($setValue="GET")
	{
		$this->requestMthod = $setValue;
		// $this->checkMethod();
	}


	public function checkMethod()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method !== $this->requestMthod)
		{
			return false;
		} else{
			return true;
		}
	}

	public function input($requestKey = 'name')
	{		
		// echo $_POST['name'];
		$codeString = 'return '.'$_POST'."['".$requestKey."']".';';
		$requestValue = eval($codeString);
		// var_dump($codeString);
		// var_dump($requestValue);
		// exit();
		return $requestValue;
	}
}
// $request = new httpRequest("POST");

