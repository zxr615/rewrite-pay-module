<?php

namespace App\Http\Services\PointTask;

use App\Http\Services\PayOrderService;
use App\Http\Services\UserService;

// 每日签到签到
class SignIn extends PointTask
{
    function send($next, $orderInfo)
    {
        if (app(UserService::class)->todayIsSinIn()) {
            return $next($orderInfo);
        }

        // 赠送积分, code...
        app(PayOrderService::class)->sendPoint(10);
        return $next($orderInfo);
    }
}
