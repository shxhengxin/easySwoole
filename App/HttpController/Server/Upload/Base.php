<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-23
 * Time: 16:17
 */

namespace App\HttpController\Server\Upload;


use App\Lib\Utils;
use Swoole\Mysql\Exception;

class Base
{
    private $request;
    /**
     * @var  对象
     */
    private $obj;
    
    /**
     * 上传文件的file -- key
     * @var string
     */
    private $type = '';

    /**
     * @var 大小
     */
    private $size;

    /**
     * @var  返回前端文件路径
     */
    public $file;


    public function __construct($request,$type=null)
    {
        $this->request = $request;
        if (empty($type)){
          $files = $this->request->getSwooleRequest()->files;
          $types = array_keys($files);
          $this->type = $types[0];
        }else{
          $this->type = $type;
        }

    }

    public function upload()
    {
        if($this->type !== $this->fileType) {
            throw new Exception("参数只能是 【 $this->fileType 】");
        }

        $this->obj = $this->request->getUploadedFile($this->type);
        $this->size = $this->obj->getSize();
        $this->checkSize(); //检查上传文件大小

        $fileName = $this->obj->getClientFileName();//文件名

        $this->checkMediaType();//文件后缀是否合法

        $file = $this->getFile($fileName);//重组文件

        $flag = $this->obj->moveTo($file);
        if(!empty($flag)) {
            return $this->file;
        }
        return false;

    }

    /**
     * 获取文件
     * @param $fileName
     * @return string
     */
    public function getFile($fileName)
    {
        $pathinfo = pathinfo($fileName);
        $extension = $pathinfo['extension'];
        $dirname = "/" . $this->type . "/" . date("Y-m-d");
        $dir = dirname(EASYSWOOLE_ROOT) . '/webroot'  . $dirname;
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        $basename = "/" . Utils::getFileKey($fileName) . "." . $extension;
        $this->file = $dirname . $basename;
        return $dir . $basename;
    }

    /**
     * 检查上传文件大小
     * @return bool
     */
    public function checkSize()
    {
        if(empty($this->size)) {

            throw new Exception("上传文件失败");
        }
        if($this->size > $this->maxSize) {
            throw new Exception("上传文件不能大于 $this->maxSize 字符");
        }

    }

    /**
     * 检测文件是否合法
     * @return bool
     * @throws \Exception
     */
    public function checkMediaType()
    {
        $clientMediaType = explode("/",$this->obj->getClientMediaType());


        $clientMediaType = $clientMediaType[1] ?? "";


        if(empty($clientMediaType)) {
            throw new Exception("上传{ $this->type }文件不合法1" );
        }
        if(!in_array($clientMediaType,$this->fileExtTypes)){
            throw new Exception("上传{ $this->type }文件不合法2" );
        }
        return true;
    }



}
