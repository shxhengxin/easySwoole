<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 23:35
 */

namespace App\HttpController;

use EasySwoole\Core\Http\AbstractInterface\Controller;
class Category extends Controller
{
    public function index()
    {
        $data = [
            'id'=>1,
            'name'=>'计算机',
        ];
        return  $this->writeJson(200,'成功',$data);
    }
}