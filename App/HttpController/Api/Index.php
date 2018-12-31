<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 23:47
 */

namespace App\HttpController\Api;

use App\HttpController\Server\Index as I;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Http\Request;
    use EasySwoole\Core\Http\Response;

class Index extends Base
{
    public  $index;

    public function __construct(string $actionName, Request $request, Response $response )
    {
        $this->index = new I();
        parent::__construct($actionName, $request, $response);
    }

    public function index()
    {

       $data = $this->index->index();
        return  $this->writeJson(200,'成功',$data);
    }

    public function getVideo()
    {

        $result = $this->db()->where('id',1)->getOne('video');
        return  $this->writeJson(200,'成功',$result);
    }

    public function getRedis()
    {

        //$result = Redis::getInstance()->get("iwanli");
        $result = $this->redis()->get("iwanli");
        return $this->writeJson(20011,'成功11',$result);
    }

    public function yaconf()
    {
        $redisConfig = \Yaconf::get('redis');
        return $this->writeJson(20011,'成功11',$redisConfig);
    }

    public function pop()
    {
        $params = $this->request()->getRequestParam();
        return $this->redis()->rPush('imooc_list_test',$params['f']);
    }
}