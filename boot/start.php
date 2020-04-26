<?php

class Start
{
	//用来保存自动加载对象
	static public $auto;
	//启动方法，即创建自动加载对象方法

	static function init()
	{
		self::$auto = new Psr4AutoLoad();
		self::router();
	}

	static function router()
	{
		//添加命名空间映射
		self::$auto->addMaps('controller', 'app/controller');
		self::$auto->addMaps('model', 'app/model');
		self::$auto->addMaps('api', 'app/api');
		self::$auto->addMaps('response', 'app/response');
		self::$auto->addMaps('request', 'app/request');
		// self::$auto->addMaps('response', 'app/response');
		//从url中获取要执行的哪个控制器中的哪个方法
		$controller = empty($_GET['controller']) ? 'index' : $_GET['controller'];
		$action = empty($_GET['action']) ? 'index' : $_GET['action'];
		//将controller处理
		$controller = ucfirst(strtolower($controller));
		//拼接带有命名空间的类名
		$controllerClass = 'controller\\'.$controller.'Controller';
		$obj = new $controllerClass();
		call_user_func([$obj, $action]);
	}

}
