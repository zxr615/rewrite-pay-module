<?php

namespace App\Http\Services\PointTask;

use App\Http\Services\PayOrderService;

// 当日首单
class TodayFirst extends PointTask
{
    function send($next, $orderInfo) {
        // 有订单直接执行下一个任务
        if (!app(PayOrderService::class)->isTodayFirst($orderInfo['orderSn'])) {
            return $next($orderInfo);
        }
        // 赠送积分
        app(PayOrderService::class)->sendPoint(100);
        return $next($orderInfo);
    }

    function recycle($next, $orderInfo) {
        // 回收积分, code...
        $next($orderInfo);
    }
}
