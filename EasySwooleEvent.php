<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Exception\ExceptionHandler;
use App\Lib\Process\ConsumerTest;
use App\Lib\Redis\Redis;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Component\SysConst;
use EasySwoole\Core\Swoole\Process\ProcessManager;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Utility\File;

Class EasySwooleEvent implements EventInterface {

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');

        Di::getInstance()->set( SysConst::HTTP_EXCEPTION_HANDLER, ExceptionHandler::class );


        // 载入项目 Conf 文件夹中所有的配置文件
        //self::loadConf(EASYSWOOLE_ROOT . '/Config');

    }

    public static function mainServerCreate(ServerManager $server,EventRegister $register): void
    {
        // TODO: Implement mainServerCreate() method.
        //mysql 相关
        //$dbConfig = Config::getInstance()->getConf("db.MYSQL");
        $dbConfig = $redisConfig = \Yaconf::get('mysql');
        Di::getInstance()->set('MYSQL',\MysqliDb::class,$dbConfig['MYSQL']);
        //redis 相关
        Di::getInstance()->set("REDIS",Redis::getInstance());

        //注册消费进程
        // TODO: Implement mainServerCreate() method.
        $allNum = 4;
        for ($i = 1 ;$i <= $allNum;$i++){
            ProcessManager::getInstance()->addProcess("imooc_consumer_testp_" . $i,ConsumerTest::class);
        }

    }

    /*public static function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDir($ConfPath);
        foreach ($files as $file) {
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array)$data);
        }
    }*/

    public static function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}