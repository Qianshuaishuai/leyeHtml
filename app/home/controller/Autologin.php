<?php

namespace app\home\controller;
use app\admin\model\TaskCategory;
use app\admin\model\Invitation;
use app\home\model\Member;
use think\Cookie;
use think\Loader;
use think\Db;
use think\Log;

/**
 * Class Index
 * @package app\home\controller
 * 首页控制器
 */
class Autologin extends Base{

    public function index(){
        // $member = floor(trim(params('member')));
        // echo $member;
        
        // header('Location: http://tasks.qimsj.com/');
        return $this->fetch(__FUNCTION__);
    }

    public function login(){
        if (request()->isAjax()) {
            $params = array_trim(request()->post());
            $member = Member::getUserInfoByUsername($params['username']);
            if(empty($member) || $member['is_del'] == 1){
                header('Location: http://tasks.qimsj.com/');
                message('会员信息不存在','','error');
            }

            if($member['is_check'] == 0){
                header('Location: http://tasks.qimsj.com/');
                message('已被管理员禁止登录','','error');
            }

            Cookie::set('member',base64_encode($member));
            // header('Location: http://tasks.qimsj.com/');
            message('自动登录成功','/home.html','success');
        }

        Cookie::delete('member');
    }

}