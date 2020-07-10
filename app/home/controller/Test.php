<?php

namespace app\home\controller;
use think\Db;
class Test extends Base{

    public function __construct(){
        parent::__construct();

        $this->member = $this->checkLogin();
    }

    public function index(){

        $category_id = floor(trim(params('category_id')));
        //任务列表
        $params = request()->request();
        if(check_array($params)){
            array_trim($params);
        }
        $params['category_id'] = $category_id;
        $pszie = 15;
        $tasks = \app\home\model\Task::getListByParams($params,$pszie);
        if(request()->isAjax()){
            if(empty($tasks)){
                message('没有更多任务','','error');
            }
            message($tasks,'','success');
        }
        $count = \app\home\model\Task::getCountByParams($params);
        $pageCount = ceil($count/$pszie);

        return $this->fetch(__FUNCTION__,[
            'tasks' => $tasks,
            'pageCount' => $pageCount
        ]);
    }

    public function detail(){
        $is_can_op = 0;
        $id = floor(trim(params('id')));
        if(!check_id($id)){
            message('任务ID错误','','error');
        }
        $item = \app\home\model\Task::getInfoById($id);
        if(empty($item)){
            message('任务不存在','','error');
        }
        if(!empty($this->member['uid']) && $item['uid'] == $this->member['uid']){
            $is_can_op = 1;
        }

        $item['audit_num'] = \app\home\model\TaskJoin::getAuditNumById($id);

        $operate_steps = \app\home\model\Task::getOperateStepsById($id);

        $member_task_join_info = NULL;
        if (isset($this->member['uid']) && $this->member['uid'] > 0) {
            $member_task_join_info = \app\home\model\TaskJoin::getInfoByTaskIdAndUid($id, $this->member['uid']);
        }

        $allow_accept = true;
        if ($item['start_time'] > TIMESTAMP || $item['origin_end_time'] < TIMESTAMP) {
            $allow_accept = false;
        }
        $gory = Db::name("task_category")->where("id = {$item['category_id']}")->find();
        if($gory['only_level'] == '1'||$gory['only_level']<1){
            $msgtt = "普通会员及以上可接";
        }elseif ($gory['only_level'] == '2') {
             $msgtt = "VIP会员及以上可接";
        }elseif ($gory['only_level'] == '3') {
             $msgtt = "高级VIP会员及以上可接";
        }else{
             $msgtt = "特级VIP会员及以上可接";
        }

        return $this->fetch(__FUNCTION__,[
            'item' => $item,
            'is_can_op' => $is_can_op,
            'operate_steps' => $operate_steps,
            'member_task_join_info' => $member_task_join_info,
            'allow_accept' => $allow_accept,
            'msgtt' => $msgtt
        ]);
    }

    public function task_join_ajax() {
        $task_id = intval(trim(params('id')));
        $where = ['task_join.task_id' => $task_id];
        $list = \app\home\model\TaskJoin::getTaskPassJoin($where, 15);

        $itemsCallback = function ($item, $key) {
            $username = $item['username'];
            if (strlen($username) >= 11) {
                $item['username'] = substr($username, 0, 3) . "*****" . substr($username, -3);
            }
            return $item;
        };

        $list->each($itemsCallback);

        to_json(0, '', $list);
    }

    //抢单任务
    public function accept(){
        $member = $this->checkLogin();
        $id = floor(trim(params('id')));
        if(!check_id($id)){
            message('任务ID错误','','error');
        }
        $item = \app\home\model\Task::getInfoById($id);
        if(empty($item)){
            message('任务不存在','','error');
        }
        if ($item['start_time'] > TIMESTAMP || $item['origin_end_time'] < TIMESTAMP) {
            message('任务不存在','','error');
        }

        if(!empty($this->member['uid']) && $item['uid'] == $this->member['uid']){
            message('无法抢单自己发布的任务','','error');
        }

         $membes_check = Db::name("member")->where("uid = {$this->member->uid}")->find();
          $taskcheck = Db::name("task")->where("id = {$id}")->find();
        $cageor = Db::name("task_category")->where("id = {$taskcheck['category_id']}")->find();
        if($cageor['only_level'] > $membes_check['level']){
            message("您会员级别不足以接该类别任务",'','error');
        }

        $member_task_join_info = \app\home\model\TaskJoin::getInfoByTaskIdAndUid($id, $this->member['uid']);
        if ($member_task_join_info && $member_task_join_info['status'] != 4) {
            message('不能重复抢单','','error');
        }

        $lastTask = \app\home\model\MyTaskJoin::getLastTaskJoin($member['uid']);
        if ($lastTask['status'] < 2 && $lastTask['status']) {
            message('请先完成已接任务，在接新任务','','error');
        }

        $item['join_num'] == \app\home\model\TaskJoin::getJoinNumByTaskId($id);
        if ($item['join_num'] >= $item['ticket_num']) {
            message('任务抢单人数已满，无法抢单','','error');
        }

        Db::startTrans();

        $params = array(
            'task_id' => $id,
            'uid' => $member['uid'],
            'status' => 1,
            'update_time' => TIMESTAMP
        );
        $insert_join_id = \app\home\model\TaskJoin::addInfo($params);
        if(!$insert_join_id){
            Db::rollback();
            message('抢单失败:-1','','error');
        }

        $status = \app\home\model\Task::incJoinNum($id);
        if(!$status){
            Db::rollback();
            message('抢单失败:-2','','error');
        }

        if ($item['join_num'] + 1 >= $item['ticket_num']) {
            $status = \app\home\model\Task::updateInfoById($id, ['is_complete' => 1]);
            if(!$status){
                Db::rollback();
                message('抢单失败:-3','','error');
            }
        }

        Db::commit();
        message('抢单成功','reload','success');
    }
    
}