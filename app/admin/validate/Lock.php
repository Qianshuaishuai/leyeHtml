<?php
namespace app\admin\validate;

class Lock extends Base{

    //验证规则
    protected $rule = [
        'name|网站名称' => 'require',
        'domain|域名' => 'require|unique:lock'
    ];
}