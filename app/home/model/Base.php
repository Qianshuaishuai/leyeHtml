<?php

namespace app\home\model;

use think\Exception;
use think\Log;
use think\Model;

class Base extends \app\admin\model\Base
{
    public static function addInfo($data)
    {
        if (!check_array($data)) {
            return false;
        }
        try {
            $data['create_time'] = TIMESTAMP;
            return self::insertGetId($data);
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return false;
        }
    }

    public static function generateRandom( $length = 32 ) {  
        // 密码字符集，可任意添加你需要的字符  
        $chars = '0123456789';  
        $password = '';  
        for ( $i = 0; $i < $length; $i++ )  
        {  
        // 这里提供两种字符获取方式  
        // 第一种是使用 substr 截取$chars中的任意一位字符；  
        // 第二种是取字符数组 $chars 的任意元素  
        // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];  
        }  
        return $password;  
    }  

    public static function updateInfoById($id, $data)
    {
        if (!check_id($id) || !check_array($data)) {
            return false;
        }
        try {
            $data['id'] = $id;
            $data['update_time'] = TIMESTAMP;
            return self::update($data);
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return null;
        }
    }
    public static function getInfoById($id)
    {
        if (!check_id($id)) {
            return null;
        }
        try {
            return self::get(['id' => $id]);
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return null;
        }
    }
    public static function deleteByIds($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }
        try {
            return self::where(['id' => ['in', $ids]])->delete();
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return null;
        }
    }
}
