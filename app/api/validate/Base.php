<?php
namespace app\api\validate;


use think\Validate;

class Base extends Validate
{
    //检测用户名
    protected function checkUserName($username){
        if(check_mobile($username)){
            return '用户名不能是手机号';
        }
        return true;
    }

    //检测手机号
    protected function checkMobile($mobile){
        if(!check_mobile($mobile)){
            return '手机号格式错误';
        }
        return true;
    }
}