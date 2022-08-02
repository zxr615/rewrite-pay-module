<?php

namespace App\Http\Services\PointTask;

// 买满多少钱赠送积分
class OverRmb extends PointTask
{
    function send($next, $orderInfo) {
        if ($orderInfo['price'] < 100) {
            return $next($orderInfo);
        }

        // 赠送积分, code...
        return $next($orderInfo);
    }

    function recycle($next, $orderInfo) {
        // 回收积分, code...
        $next($orderInfo);
    }
}
