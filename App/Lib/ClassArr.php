<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-31
 * Time: 14:57
 */

namespace App\Lib;

/**
 * Class ClassArr  做一些反射机制有关的 处理
 * @package App\Lib
 */
class ClassArr
{
    public function uploadClassStat()
    {
        return [
          "image" => "\App\HttpController\Server\Upload\Image",
          "video" => "\App\HttpController\Server\Upload\Video",
        ];
    }

  /**
   * @param $type
   * @param $supportedClass
   * @param array $params
   * @param bool $needInstance
   * @return mixed
   */
    public function initClass($type,$supportedClass, $params=[], $needInstance = true)
    {
        if(!array_key_exists($type, $supportedClass)) {
          throw new Exception("$type 不在存在" );
        }

        $className = $supportedClass[$type];
        return $needInstance ? (nwe \ReflectionClass($className))->newInstanceArgs($params) : $className;
    }
}
