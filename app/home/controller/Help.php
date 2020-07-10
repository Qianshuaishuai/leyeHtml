<?php
namespace app\home\controller;


class Help extends Base
{
    public function index(){
        return $this->fetch(__FUNCTION__);
    }
}