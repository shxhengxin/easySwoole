<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-23
 * Time: 17:40
 */

namespace App\Lib;


class Utils
{
    /**
     * 生成的唯一性key
     * @param $str
     * @return bool|string
     */
    public static function getFileKey($str)
    {
        return substr(md5(self::makeRabdomString() . $str . time() . rand(0, 9999)),8,16);
    }

    /**
     * 生成随机字符串
     * @param int $length
     * @return string|null
     */
    public static function makeRabdomString($length = 1)
    {
        $str = null;
        $strPol = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789";
        $max = strlen($strPol) - 1;

        for($i=0;$i<$length;$i++) {
            $str .= $strPol[rand(0,$max)];
        }
        return $str;

    }
}



















