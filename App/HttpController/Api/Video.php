<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-31
 * Time: 16:08
 */

namespace App\HttpController\Api;

use App\Model\Video as VideoModel;
use EasySwoole\Core\Http\Message\Status;
use EasySwoole\Core\Utility\Validate\Rule;
use EasySwoole\Core\Utility\Validate\Rules;


class Video extends Base
{
    public function add()
    {
        $params = $this->request()->getRequestParam();
        //数据检验

        $ruleObj = new Rules();
        $ruleObj->add('name','视频名称错误')->withRule(Rule::REQUIRED)->withRule(Rule::MIN_LEN,2)->withRule(Rule::MAX_LEN,20);
        $Validate = $this->validateParams($ruleObj);
        if($Validate->hasError()) {
            return $this->writeJson(Status::CODE_BAD_REQUEST,$Validate->getErrorList()->first()->getMessage());
        }


        $data = [
            'name' => $params['name'],
            'url' => $params['url'],
            'image' => $params['image'],
            'content' => $params['content'],
            'cat_id' => $params['cat_id'],
            'create_time' => $params['name'],
            'status' => 1
        ];

        try {
            $modelObj = new VideoModel();
            $videoId = $modelObj->add($data);
        }catch (\Exception $e) {
            return $this->writeJson(Status::CODE_BAD_REQUEST,$e->getMessage());
        }
        if(!empty($videoId)){
            return $this->writeJson(Status::CODE_OK,'插入成功',['id'=>$videoId]);
        }
        return  $this->writeJson(Status::CODE_BAD_REQUEST,'插入失败');

    }
}
