<?php

namespace app\home\model;

use think\Exception;
use think\Log;

class Task extends Base
{
    protected $table = 'tb_task';
    public static function getTotalCountByMemberId($uid)
    {
        if (!check_id($uid)) {
            return 0;
        }
        try {
            return self::where(['uid' => $uid])->count();
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
            $list = self::query("SELECT a.*,b.username,b.avatar,b.level FROM tb_task a LEFT JOIN tb_member b ON a.uid=b.uid WHERE a.id={$id}");
            if (!empty($list[0])) {
                $list[0]['percent'] = round(floatval($list[0]['join_num'] / $list[0]['ticket_num'] * 100), 2);
                $list[0]['origin_end_time'] = $list[0]['end_time'];
                $list[0]['end_time'] = date('Y-m-d H:i', $list[0]['end_time']);
                if (!empty($list[0]['thumbs'])) {
                    $list[0]['thumbs'] = unserialize($list[0]['thumbs']);
                }
                if (!empty($list[0]['start_time'])) {
                    $list[0]['format_start_time'] = date('Y-m-d H:i', $list[0]['start_time']);
                }
                return $list[0];
            }
            return null;
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return false;
        }
    }
    public static function getOperateStepsById($id)
    {
        if (!check_id($id)) {
            return [];
        }
        try {
            $list = self::query("SELECT * FROM tb_task_operate_steps WHERE task_id={$id} ORDER BY sort");
            return !is_null($list) ? $list : [];
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return [];
        }
    }
    public static function getTodayTotalCredit()
    {
        $data = [0.00, 0.00];
        try {
            $where = "is_complete=0 AND is_display=1 AND check_period*3600+create_time<" . TIMESTAMP;
            $where .= " AND start_time<" . TIMESTAMP;
            $where .= " AND end_time>" . TIMESTAMP;
            $item = self::query("SELECT SUM((give_credit2-fee)/ticket_num) AS credit2,SUM(give_credit1/ticket_num) AS credit1 FROM tb_task WHERE {$where}");
            if (!empty($item[0]['credit1'])) {
                $data[0] = round(floatval($item[0]['credit1']), 2);
            }
            if (!empty($item[0]['credit2'])) {
                $data[1] = round(floatval($item[0]['credit2']), 2);
            }
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
        }
        return $data;
    }
    public static function getListByParams($params = [], $psize = 15)
    {
        $page = get_now_page();
        $pindex = ($page - 1) * $psize;
        $orderby = " ORDER BY end_time DESC, top_end_time DESC, id DESC";
        $where = "is_complete=0 AND is_display=1 AND check_period_time<" . TIMESTAMP;
        if (!isset($params['search_type']) || $params['search_type'] == 0) {
            $where .= " AND start_time<" . TIMESTAMP;
            $where .= " AND end_time>" . TIMESTAMP;
        }
        if (check_array($params)) {
            if (!empty($params['search_type']) && $params['search_type'] == 1) {
                $t_start_time = strtotime(date('Y-m-d 00:00:00'));
                $t_end_time = strtotime(date('Y-m-d 23:59:59'));
                $where .= " AND end_time BETWEEN {$t_start_time} AND {$t_end_time}";
            }
            if (!empty($params['keyword'])) {
                $where .= " AND title LIKE '%{$params['keyword']}%'";
            }
            if (!empty($params['category_id'])) {
                $where .= " AND category_id='{$params['category_id']}'";
            }
            if (!empty($params['order_type'])) {
                switch ($params['order_type']) {
                    case 1:
                        $orderby = " ORDER BY top_end_time DESC, give_credit2 DESC";
                        break;
                    case 2:
                        $orderby = " ORDER BY top_end_time DESC, give_credit1 DESC";
                        break;
                    case 3:
                        $orderby = " ORDER BY top_end_time DESC, join_num/ticket_num DESC";
                        break;
                    case 4:;
                        break;
                }
            }
        }
        $where .= $orderby;
        $tasks = self::query("SELECT * FROM tb_task WHERE {$where} LIMIT {$pindex},{$psize}");
        if (!empty($tasks)) {
            foreach ($tasks as &$v) {
                $v['percent'] = round(floatval($v['join_num'] / $v['ticket_num'] * 100), 2);
                $v['end_time'] = date('Y-m-d H:i', $v['end_time']);
            }
        }
        return $tasks;
    }
    public static function getCountByParams($params = [], $psize = 15)
    {
        try {
            $where = "is_complete=0 AND is_display=1 AND check_period_time<" . TIMESTAMP;
            if (!isset($params['search_type']) || $params['search_type'] == 0) {
                $where .= " AND start_time<" . TIMESTAMP;
                $where .= " AND end_time>" . TIMESTAMP;
            }
            if (check_array($params)) {
                if (!empty($params['search_type']) && $params['search_type'] == 1) {
                    $t_start_time = strtotime(date('Y-m-d 00:00:00'));
                    $t_end_time = strtotime(date('Y-m-d 23:59:59'));
                    $where .= " AND end_time BETWEEN {$t_start_time} AND {$t_end_time}";
                }
                if (!empty($params['keyword'])) {
                    $where .= " AND title LIKE '%{$params['keyword']}%'";
                }
                if (!empty($params['category_id'])) {
                    $where .= " AND category_id='{$params['category_id']}'";
                }
            }
            $info = self::query("SELECT COUNT(1) AS num FROM tb_task WHERE {$where}");
            return !empty($info[0]['num']) ? $info[0]['num'] : 0;
        } catch (Exception $e) {
            Log::error(__FILE__ . ':' . __LINE__ . ' 错误：' . $e->getMessage());
            return null;
        }
    }
    public static function incJoinNum($id, $step = 1)
    {
        return self::where(['id' => $id])->setInc('join_num', $step);
    }
}
