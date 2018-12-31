<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-01
 * Time: 19:29
 */

namespace App\Lib\Redis;


use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;

class Redis
{
    use Singleton;
    public $redis;
    private function __construct()
    {
        if(!extension_loaded('redis')) {
            throw  new \Exception("redis扩展未安装");
        }
        try{
            //$redisConfig = Config::getInstance()->getConf("redis.REDIS");
            $redisConfig = \Yaconf::get('redis');
        /*var_dump($redisConfig['REDIS']['host']);
        var_dump($redisConfig['REDIS']['port']);
        var_dump($redisConfig['REDIS']['time_out']);*/

            $this->redis = new \Redis();
            $result = $this->redis->connect($redisConfig['REDIS']['host'],$redisConfig['REDIS']['port'],$redisConfig['REDIS']['time_out']);
        }catch (\Exception $e){
            throw  new \Exception("redis服务异常");
        }
        if($result === false) {
            throw  new \Exception("redis连接失败");
        }
    }

   /* public function __call($name,$arguments) {

         return call_user_func_array([$this->redis,$name],$arguments);
    }*/	


   
    /**
     * 获取redis值
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        if(empty($key)) return 'key不允许为空';

        return $this->redis->get($key);
    }

    /**
     *  写入缓存
     * @param $key key 值
     * @param $value value 值
     * @param string $expiration 过期时间
     * @return bool 返回值
     */
    public function set($key,$value,$expiration = null )
    {
        if(empty($key)) return 'key不允许为空';

        if(empty($value)) return 'value不允许为空';

        return $this->redis->set($key,$value,$expiration);
    }

    /**
     * 消费者
     * @param $key
     * @return string
     */
    public function lPop($key)
    {
        if(empty($key)) return 'key不允许为空';
        return $this->redis->lPop($key);
    }

    /**
     * 入队列
     * @param $key
     * @return string
     */
    public function rPush($key,$value)
    {
        if(empty($key)) return 'key不允许为空';
        return $this->redis->rPush($key,$value);
    }
}
