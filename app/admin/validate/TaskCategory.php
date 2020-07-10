<?php
namespace app\admin\validate;

class TaskCategory extends Base{

    //验证规则
    protected $rule = [
        'title|分类名称' => 'require',
        'thumb|分类图标' => 'require',
    ];

    //错误提示信息
    protected $message = [
        'thumb.require' => '请上传分类图片'
    ];
}