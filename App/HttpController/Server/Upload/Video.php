<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-23
 * Time: 16:26
 */

namespace App\HttpController\Server\Upload;


class Video extends Base
{
    /**
     * @var string
     */
    public $fileType = "video";

    /**
     * 视频大小 30M
     * @var int
     */
    public $maxSize = 31457280;
    /**
     * 文件后缀
     * @var array
     */
    public $fileExtTypes = [
        'mp4','x-flv'
    ];
}