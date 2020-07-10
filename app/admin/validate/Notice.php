<?php
namespace app\admin\validate;

class Notice extends Base{

    //验证规则
    protected $rule = [
        'title|标题' => 'require',
        'detail|详情' => 'require',
        'order_by|排序' => 'number',
        'is_display|状态' => 'in:0,1'
    ];
}