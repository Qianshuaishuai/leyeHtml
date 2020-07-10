<?php

namespace app\api\controller;



class Lock extends Base
{

    //获取锁文件
    public function get(){
        to_json(0,'验证成功');
    }
}