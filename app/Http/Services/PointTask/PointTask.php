<?php

namespace App\Http\Services\PointTask;

abstract class PointTask
{
    // 发送积分
    abstract function send($next, $orderInfo);

    // 回收积分
    public function recycle($next, $orderInfo)
    {
        return $next($orderInfo);
    }
}
