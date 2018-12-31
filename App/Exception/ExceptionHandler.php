<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-12-01
 * Time: 22:49
 */

namespace App\Exception;


use EasySwoole\Core\Http\AbstractInterface\ExceptionHandlerInterface;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(\Throwable $throwable, Request $request, Response $response)
    {

        if($throwable->getCode() == 0 ) {
            $data = [
                'status' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
                'list'    => ''
            ];
            $response->write(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            $response->withHeader('Content-type','application/json;charset=utf-8');
            $response->withStatus(401);

        }
    }

}