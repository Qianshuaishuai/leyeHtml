<?php

namespace app\home\controller;

use app\common\controller\NotifyHandler;

use app\home\model\Recharge as UserRecharge;
use app\home\model\CreditRecord;
use app\home\model\Member;
use think\Db;
use think\Log;

/**
* 通知处理控制器
*
* 完善getOrder, 获取订单信息, 注意必须数组必须包含out_trade_no与total_amount
* 完善checkOrderStatus, 返回订单状态, 按要求返回布尔值
* 完善handle, 进行业务处理, 按要求返回布尔值
*
* 请求地址为index, NotifyHandler会自动调用以上三个方法
*/
class Notify extends NotifyHandler
{
    protected $params; // 订单信息

    public function index()
    {
        parent::init();
    }

     public function mazhifunotify(){
       // var_dump("11");
        file_put_contents("11.txt",json_encode($_REQUEST));
        ksort($_POST); //排序post参数
        reset($_POST); //内部指针指向数组中的第一个元素
       
        $codepay_key=config('mcode.key'); //密钥
        $sign = '';//初始化
        foreach ($_POST AS $key => $val) { //遍历POST参数
            if ($val == '' || $key == 'sign') continue; //跳过不签名
            if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
            $sign .= "$key=$val"; //拼接为url参数形式
        }
        if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) { //不合法的数据
            exit('fail');  //返回失败 继续补单
        } else { //合法的数据
            //业务处理
            $pay_id = $_POST['pay_id']; //需要充值的ID 或订单号 或用户名
            $money = (float)$_POST['money']; //实际付款金额
            $price = (float)$_POST['price']; //订单的原价
            $param = $_POST['param']; //自定义参数
            $pay_no = $_POST['pay_no']; //流水号
            /////////////////////////////////////
            if(abs($money-$price) > '0.1'){
                 exit('fail');
            }
            $res1aaa = Db::name("recharge")->where("account = '{$pay_id}'")->find();
            if($res1aaa['status'] > 0){
                exit('fail');
            }
            $update['status'] = 1;
            $update['note'] = $pay_no;
            $update['pay_time'] = date('Y-m-d H:i:s', time());
            $update['update_time'] = time(); 
            $res1 = Db::name("recharge")->where("account = '{$pay_id}'")->update($update);
            $Member_che = Db::name("member")->where("uid = {$param}")->find();
            $ying['credit2'] = $Member_che['credit2']+$price;
            file_put_contents("3333.txt", $ying['credit2']);
            $ying_che = Db::name("member")->where("uid = {$param}")->update($ying);
              $status2['uid'] =$param;
              $status2['type'] ='credit2';
              $status2['num'] =$price;
              $status2['title'] ='会员充值';
              $status2['remark'] ="支付宝充值金额：{$price}。";
              $status2['create_time'] =time();

            
              file_put_contents('2222.txt',json_encode($status2));
            $ass = Db::name("credit_record")->insert($status2);                  
            exit('success'); //返回成功 不要删除哦
        }
    }
    /**
     * 获取订单信息, 必须包含订单号和订单金额
     *
     * @return string $params['out_trade_no'] 商户订单
     * @return float  $params['total_amount'] 订单金额
     */
    public function getOrder()
    {
        $out_trade_no = $_POST['out_trade_no'];

        Log::error(__FILE__.':'.__LINE__.' Data: '. $out_trade_no);

        $recharge = UserRecharge::getInfoById($out_trade_no);
        $params = [
            'out_trade_no' => $recharge['id'],
            'total_amount' => $recharge['credit2'],
            'status'       => $recharge['status'],
            'credit2'      => $recharge['credit2'],
            'uid'          => $recharge['uid'],
            'id'           => $recharge['id']
        ];
        $this->params = $params;
    }

    /**
     * 检查订单状态
     *
     * @return Boolean true表示已经处理过 false表示未处理过
     */
    public function checkOrderStatus()
    {
        if($this->params['status'] == 0) {
            // 表示未处理
            return false;
        } else {
            return true;
        }
    }

    /**
     * 业务处理
     * @return Boolean true表示业务处理成功 false表示处理失败
     */
    public function handle()
    {

        Db::startTrans();

        $update = [];
        $update['status'] = 1;
        $update['note'] = '';
        $update['pay_time'] = date('Y-m-d H:i:s', TIMESTAMP);
        $update['update_time'] = TIMESTAMP;
        $status = UserRecharge::updateInfoById($this->params['id'], $update);
        if(!$status){
            Db::rollback();
            return false;
        }

        $credit2 = $this->params['credit2'];
        $status1 = Member::updateCreditById($this->params['uid'], 0, $credit2);
        if(!$status1){
            Db::rollback();
            return false;
        }
        $status2 = CreditRecord::addInfo([
            'uid' => $this->params['uid'],
            'type' => 'credit2',
            'num' => $credit2,
            'title' => '会员充值',
            'remark' => "支付宝充值金额：{$credit2}。",
            'create_time' => TIMESTAMP
        ]);
        if(!$status2){
            Db::rollback();
            return false;
        }

        Db::commit();

        return true;
    }
}