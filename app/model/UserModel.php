<?php

namespace model;
use model\MySql;

class UserModel extends MySql
{
	protected $table = 'user';
	protected $sql = '';

	function stAlUsLogIf()
	{
		$this->table = 'log';
		$this->sql = 'SELECT * FROM '.$this->table.';';
		$datas = $this->getAll($this->sql);
		return $datas;
	}
}

// $userModel = new UserModel();
// $datas = $userModel->stAlUsLogIf();
// var_dump($datas);
// echo $data;