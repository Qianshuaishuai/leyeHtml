<?php

namespace app\home\controller;

use think\Db;
use think\Log;
use app\home\model\Follow;

class Vip extends Base{

	public function __construct(){
		parent::__construct();

		$this->member = $this->checkLogin();
	}

    public function index(){
        $list = Db::name("member_level")->where("is_effect = 1")->select();
        $info = Db::name("member")->where("uid = {$this->member->uid}")->find();

          return $this->fetch(__FUNCTION__,[
            'list' => $list,
            'info' => $info,
        ]);
    }

    public function openvip(){
      //  $this->giverepay($this->member->uid);
       // die;
         $params = request()->post();
        $id = trim(params('id'));
        $info = Db::name("member_level")->where("id = {$id}")->find();
        $memberres = Db::name("member")->where("uid = {$this->member->uid}")->find();
        if($info['level'] <= $this->member->level){
            $ms['status']= 0;
            $ms['message'] = "已开通该会员";
            exit(json_encode($ms)); 
        }
        if($memberres['level']>1){
            $checkinfo = Db::name("member_level")->where("level = {$memberres['level']}")->find();
          
             $ying = $info['have_money']-$checkinfo['have_money'];
           
             if($ying > $this->member->credit2){
                $ms['status']= 2;
                $ms['message'] = "余额不足，请充值";
                exit(json_encode($ms));
            }
            $data['level'] = $info['level'];

            $data['credit2'] = $this->member->credit2 - $ying;

        }else{
             if($info['have_money'] > $this->member->credit2){
                $ms['status']= 2;
                $ms['message'] = "余额不足，请充值";
                exit(json_encode($ms));
            }
            $data['level'] = $info['level'];
            $data['credit2'] = $this->member->credit2 - $info['have_money'];
            $ying = $info['have_money'];
        }
      
        $res = Db::name("member")->where("uid = {$this->member->uid}")->update($data);
        if($res){
            $dede['uid'] = $this->member->uid;
            $dede['type'] = 'credit2';
            $dede['num'] = '-'.$ying;
            $dede['title'] = '开通vip';
            $dede['remark']="您已开通{$info['title']}";
            $dede['create_time'] = time();
            $stas = Db::name("credit_record")->insert($dede);
            if($stas){
                $this->giverepay($this->member->uid,$id);
                $ms['status']= 1;
                $ms['message'] = "开通成功";
                exit(json_encode($ms));
            }else{
                $ms['status']= 0;
                $ms['message'] = "开通失败";
                exit(json_encode($ms));
            }

        }else{
            $ms['status']= 0;
            $ms['message'] = "开通失败";
            exit(json_encode($ms));
        }


    }

    function giverepay($uid,$level_id){
        $level_info = Db::name("member_level")->where("id = {$level_id}")->find();
        $member_info = Db::name("member")->where("uid = {$uid}")->find();

        ////////////////////////////////////////////////
        if($member_info['parent_uid'] > 0){
            $up_1 =  Db::name("member")->where("uid = {$member_info['parent_uid']}")->find();
             $data['credit2'] = $up_1['credit2'] + $level_info['repay_1'];
              $res = Db::name("member")->where("uid = {$up_1['uid']}")->update($data);
                if($res){
                    $dede['uid'] = $up_1['uid'];
                    $dede['type'] = 'credit2';
                    $dede['num'] = '+'.$level_info['repay_1'];
                    $dede['title'] = '返佣';
                    $dede['remark']="{$uid}开通vip返佣";
                    $dede['create_time'] = time();
                    $stas = Db::name("credit_record")->insert($dede);
                    unset($dede['type']);
                    unset($dede['title']);
                    $stasa = Db::name("invitation_rebate_record")->insert($dede);
                }
         ///////////////////////////////////////////////
            if($up_1['parent_uid'] > 0){
                    $up_2 =  Db::name("member")->where("uid = {$up_1['parent_uid']}")->find();
                     $data['credit2'] = $up_2['credit2'] + $level_info['repay_2'];
                      $res2 = Db::name("member")->where("uid = {$up_2['uid']}")->update($data);
                        if($res2){
                            $dede1['uid'] = $up_2['uid'];
                            $dede1['type'] = 'credit2';
                            $dede1['num'] = '+'.$level_info['repay_2'];
                            $dede1['title'] = '返佣';
                            $dede1['remark']="{$uid}开通vip返佣";
                            $dede1['create_time'] = time();
                            $stas1 = Db::name("credit_record")->insert($dede1);
                            unset($dede1['type']);
                             unset($dede1['title']);
                             $stasaa1 = Db::name("invitation_rebate_record")->insert($dede1);
                        }
                    ///////////////////////////////////////////////
                if($up_2['parent_uid'] > 0){
                        $up_3 =  Db::name("member")->where("uid = {$up_2['parent_uid']}")->find();
                         $data['credit2'] = $up_3['credit2'] + $level_info['repay_3'];
                          $res3 = Db::name("member")->where("uid = {$up_3['uid']}")->update($data);
                            if($res3){
                                $dede['uid'] = $up_3['uid'];
                                $dede['type'] = 'credit2';
                                $dede['num'] = '+'.$level_info['repay_3'];
                                $dede['title'] = '返佣';
                                $dede['remark']="{$uid}开通vip返佣";
                                $dede['create_time'] = time();
                                $stas3 = Db::name("credit_record")->insert($dede);
                                unset($dede['type']);
                                unset($dede['title']);
                                 $stasab3 = Db::name("invitation_rebate_record")->insert($dede);
                            }
                    }
                }

        }

    }

  

}