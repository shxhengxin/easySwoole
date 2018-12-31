<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 23:47
 */

namespace App\HttpController\Api;



use App\HttpController\Server\Upload\Image;
use App\HttpController\Server\Upload\Video;
use App\Lib\ClassArr;
use EasySwoole\Core\Component\Di;


class Upload extends Base
{

    public function file()
    {
        $request = $this->request();
        $files = $request->getSwooleRequest()->files;
        $types = array_keys($files);
        $type = $types[0];

        if(empty($type)){
            return $this->writeJson(400,"上传文件不合法");
        }



        /*if($type == 'image'){
           $obj =  "\App\HttpController\Server\Upload\Image";
        }elseif ($type == 'video') {
          $obj =  "\App\HttpController\Server\Upload\Video";
        }*/



        try {
            //$obj = new Video($request);
            //$obj = new $obj($request);


            $classObj = new ClassArr();
            $classStats = $classObj->uploadClassStat();
            $uploadObj = $classObj->initClass($type,$classStats,[$request,$type]);
            $file = $uploadObj->upload();

        }catch (\Exception $e) {
            return $this->writeJson(400,$e->getMessage(),[]);
        }
        if(empty($file)) {
            return $this->writeJson(400,"上传失败",[]);
        }
        return $this->writeJson(200,"上传成功",['url'=>$file]);


    }
}
