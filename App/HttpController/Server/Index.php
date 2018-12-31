<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-01
 * Time: 22:32
 */

namespace App\HttpController\Server;




use App\HttpController\Api\Base;

class Index
{


    public function index()
    {
        $data = [
            'id'=>1,
            'name'=>'2018年计算机',
        ];
       /* if($data){
            throw new \Exception("error122",0);
        }*/

        return $data;
    }
}