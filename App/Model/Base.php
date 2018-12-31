<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-31
 * Time: 15:57
 */

namespace App\Model;


use EasySwoole\Core\Component\Di;

class Base
{
    public $db = "";


    public function __construct()
    {
        if(empty($this->tableName)) {
            throw new \Exception("table error");
        }

        $db = Di::getInstance()->get("MYSQL");
        if($db instanceof  \MysqliDb) {
            $this->db = $db;
        } else {
          throw new \Exception("db error");
        }
    }


    public function add($data)
    {
        if(empty($data) && !is_array($data)) {
          throw new \Exception("传参错误");
        }
        return $this->db->insert($this->tableName,$data);
    }
}
