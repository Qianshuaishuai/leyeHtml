<?php

namespace app\home\model; use think\Exception; use think\Log; class Banner extends Base { protected $table = 'tb_banner'; public static function getList($count = 10){ try{ return self::where(['is_display' => 1])->order('order_by desc')->limit($count)->select(); }catch (Exception $e){ Log::error(__FILE__.':'.__LINE__.' 错误：'.$e->getMessage()); return null; } } }