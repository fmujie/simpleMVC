<?php

class Psr4AutoLoad
{
	protected $maps = [];
	
	function __construct()
	{
		spl_autoload_register([$this, 'autoLoad']);
	}

	function autoLoad($className)
	{
		//echo $className;
		//完整的类名由命名空间名和类名组成
		//得到命名空间名，再根据命名空间名得到其文件的目录路径
		$pos = strrpos($className, '\\');
		//echo $pos;
		$namespace = substr($className, 0, $pos);
		//echo $namespace;
		//得到类名
		$realClass = substr($className, $pos + 1);
		// echo $realClass;
		//找到文件并且包含进来
		$this->mapLoad($namespace, $realClass);
	}


	//根据命名空间名得到目录路径并且拼接真正的文件全路径
	protected function mapLoad($namespace, $realClass)
	{
		if(array_key_exists($namespace, $this->maps))
		{
			$namespace = $this->maps[$namespace];
		}

		//处理路径
		$namespace = rtrim(str_replace('\\/', '/', $namespace), '/').'/';
		//拼接文件全路径
		//echo "$namespace <br/>";
		$filePath = $namespace.$realClass.'.php';
		//echo "$filePath <br/>";
		//将文件包含进来
		if(file_exists($filePath))
		{
			include $filePath;
		} else {
			die('文件不存在');
		}
		
	}

	public function addMaps($namespace, $path)
	{
		if(array_key_exists($namespace, $this->maps))
		{
			die('映射过');
		}
		$this->maps[$namespace] = $path;
	}
}

