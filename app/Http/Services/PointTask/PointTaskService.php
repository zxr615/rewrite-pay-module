<?php

namespace App\Http\Services\PointTask;

use App\Http\Services\PayOrderService;
use Illuminate\Pipeline\Pipeline;

class PointTaskService
{
    // 定义了可能同时触发的任务
    public $shopping = [
        TodayFirst::class,
        OverRmb::class,
    ];

    // 购物赠送积分
    public function shoppingSend($orderSn)
    {
        $orderInfo = app(PayOrderService::class)->getOrderInfoByOrderNo($orderSn);
        return (new Pipeline(app()))
            ->send($orderInfo)
            ->via('send')
            ->through($this->shopping)
            ->thenReturn();
    }

    // 购物退款回收积分
    public function shoppingRecycle($orderSn)
    {
        $orderInfo = app(PayOrderService::class)->getOrderInfoByOrderNo($orderSn);
        return (new Pipeline(app()))
            ->send($orderInfo)
            ->via('recycle')
            ->through($this->shopping)
            ->thenReturn();
    }

    // 每日签到
    public function signIn()
    {
        return (new Pipeline(app()))
            ->via('send')
            ->through(SignIn::class)
            ->thenReturn();
    }
}
