<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-23
 * Time: 18:22
 */

namespace App\HttpController\Server\Upload;


class Image extends Base
{
    /**
     * @var string
     */
    public $fileType = "image";

    /**
     * 图片大小  3M
     * @var int
     */
    public $maxSize = 3145728;
    /**
     * 文件后缀
     * @var array
     */
    public $fileExtTypes = [
        'jpg','jpeg','png'
    ];
}