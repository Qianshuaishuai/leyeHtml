<?php

namespace app\home\controller;

use app\home\model\Recharge as UserRecharge;
use think\Db;
use think\Log;

class Recharge extends Base
{
    public function index()
    {
        $member = $this->checkLogin();
        return $this->fetch(__FUNCTION__);
    }

    public function post()
    {
        $member = $this->checkLogin();

        $params = request()->post();
        $result = $this->validate($params, 'Recharge');
        if ($result !== true) {
            message($result, '', 'error');
        }

        //处理是整数的
        //params_floor(['credit2'], $params);

        if ($params['credit2'] < 0) {
            message('充值金额不能少于0元', '', 'error');
        }
        $params['pay_type'] = 3;
        //$type2= $params['tp'] ;
        //$params['thumbs'] = '';
        $ordertt = "TD" . time();
        Db::startTrans();
        $status3 = UserRecharge::addInfo([
            'uid' => $member['uid'],
            'username' => $member['username'],
            'credit2' => $params['credit2'],
            'realname' => '',
            'account' => $ordertt,
            'pay_time' => '',
            //'thumbs' => $params['thumbs'],
            'create_time' => TIMESTAMP
        ]);

        if (!$status3) {
            Db::rollback();
            message('充值失败!', '', 'error');
            //message('提现失败：-3','','error');
        }

        $payparams = array(
            'subject' => '充值-' . $params['credit2'],
            'out_trade_no' => UserRecharge::generateRandom(),
            'total_amount' => $params['credit2'],
            'domain' => $this->get_domain()
        );

        if ($params['pay_type'] == 1) {
            $payparams['goods_tag'] = '';
            $payparams['notify_url'] = $this->get_domain() . 'home/wxnotify/index.html';
            $payparams['wap_url'] = $this->get_domain() . '/home/account.html';
            $payparams['wap_name'] = '充值-' . $params['credit2'];

            // $h5pay = new \wxpay\H5pay();
            //  $result = $h5pay->pay($payparams);

            Db::commit();

            $codepay_id = config('mcode.id'); //码支付ID
            $codepay_key = config('mcode.key'); //密钥

            $data = array(
                "id" => $codepay_id, //你的码支付ID
                "pay_id" => $ordertt, //唯一标识 可以是用户ID,用户名,session_id(),订单ID,ip 付款后返回 sucaihuo.com
                "type" => $type2, //1支付宝支付 3微信支付 2QQ钱包
                "price" => $params['credit2'], //金额100元
                "param" => $member['uid'], //自定义参数
                "notify_url" => 'http://' . $_SERVER['SERVER_NAME'] . '/home/notify/mazhifunotify', //通知地址

                "return_url" => 'http://' . $_SERVER['SERVER_NAME'] . '/home/account', //跳转地址
            ); //构造需要传递的参数

            ksort($data); //重新排序$data数组
            reset($data); //内部指针指向数组中的第一个元素

            $sign = ''; //初始化需要签名的字符为空
            $urls = ''; //初始化URL参数为空

            foreach ($data as $key => $val) { //遍历需要传递的参数
                if ($val == '' || $key == 'sign') continue; //跳过这些不参数签名
                if ($sign != '') { //后面追加&拼接URL
                    $sign .= "&";
                    $urls .= "&";
                }
                $sign .= "$key=$val"; //拼接为url参数形式
                $urls .= "$key=" . urlencode($val); //拼接为url参数形式并URL编码参数值

            }
            $query = $urls . '&sign=' . md5($sign . $codepay_key); //创建订单所需的参数
            $url = "http://api2.fateqq.com:52888/creat_order/?{$query}"; //支付页面

            header("Location:{$url}"); //跳转到支付页面
            // $this->redirect($result["mweb_url"] . "&redirect_url=" . urlencode($payparams['wap_url']));

        } elseif ($params['pay_type'] == 2) {
            $wappay = new \alipay\Wappay();
            $result = $wappay->pay($payparams);
            // echo json_encode($result);

            Db::commit();
        } elseif ($params['pay_type'] == 3) {
            $payparams['goods_tag'] = '';
            $payparams['notify_url'] = $this->get_domain() . 'home/wxnotify/index.html';
            $payparams['wap_url'] = $this->get_domain() . '/home/account.html';
            $payparams['wap_name'] = '充值-' . $params['credit2'];
       
            $h5pay = new \wxpay\H5pay();
            $result = $h5pay->pay($payparams);
            echo json_encode($result);

            Db::commit();
            // echo $result;    
            $this->redirect($result["mweb_url"] . "&redirect_url=" . urlencode($payparams['wap_url']));
            // header("Location:{$web_url}");
        } else {
            message('提现失败', '', 'error');
        }
    }
}
