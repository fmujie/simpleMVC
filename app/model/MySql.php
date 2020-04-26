<?php
namespace model;

class MySql
{
    protected $link; //MySql连接
    protected $data = [];

    function __construct()
    {
        $this->conn();
    }
    protected function conn()
    {
        $cfg = array(
            'host' => HOST,
            'user' => USER,
            'pwd' => PWD,
            'db' => DB,
            'charset' => CHARSET,
        );

        $this->link = mysqli_connect($cfg['host'], $cfg['user'], $cfg['pwd'], $cfg['db']);

        if (mysqli_connect_errno($this->link)) {
            echo "连接 MySQL 失败: " . mysqli_connect_error();
        }

        mysqli_query($this->link, 'set names ' . $cfg['charset']);
    }

    public function query($sql)
    {
        return mysqli_query($this->link, $sql);
    }

    public function getAll($sql)
    {
        $res = $this->query($sql);
        //var_dump($res);
        $data = $this->parseToArr($res);
        $date = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        return $data;
    }

    public function parseToArr($obj)
    {
        while ($row = mysqli_fetch_assoc($obj)) {
            $this->data[] = $row;
        }
        return $this->data;
    }
}
// $mysql = new MySql();
// $mysql->conn();
// $sql = 'SELECT * FROM log';
// $datas = $mysql->getAll($sql);
// var_dump($datas);
// var_dump($mysql->link);
