<?php
namespace app\admin\validate;

class Channel extends Base{

    //验证规则
    protected $rule = [
        'title|名称' => 'require'
    ];
}