<?php
namespace app\home\controller;


class Agree extends Base
{
    public function index(){
        return $this->fetch(__FUNCTION__);
    }
}