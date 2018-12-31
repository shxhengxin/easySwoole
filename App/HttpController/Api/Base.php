<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/1
 * Time: 0:14
 */

namespace App\HttpController\Api;


use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Base extends Controller
{
    public function index()
    {
        // TODO: Implement index() method.
    }


    /**
     * 获取redis连接实例
     * @return string|null
     */
    public function redis()
    {
        $redis = Di::getInstance()->get('REDIS');
        return $redis;
    }

    /** 权限相关
     * @param $action
     * @return bool|null
     */
    public function onRequest($action):?bool
    {
        return true;
    }

    /**
     *
     * @param \Throwable $throwable
     * @param $actionName
     * @throws \Throwable
     */
   /* public function onException(\Throwable $throwable,$actionName):void
    {
        $this->writeJson(400,$throwable);
    }*/
}
