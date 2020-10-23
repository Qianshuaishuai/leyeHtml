<?php
namespace app\home\controller;


class Rule extends Base
{
    public function index(){
        return $this->fetch(__FUNCTION__);
    }
}