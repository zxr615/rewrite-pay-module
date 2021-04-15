<?php


namespace App\Http\Services\PayOrder;


use App\Exceptions\BusinessException;
use App\Exceptions\TemporaryOrderException;
use App\Http\Services\PayOrder\Strategy\VipStrategy;
use App\Http\Services\PayOrderService;

class PreviewFactory
{
    public static function strategy(string $key)
    {
        // 获取临时订单
        $tmpOrder = app(PayOrderService::class)->getTemporaryOrder($key);

        if (!$tmpOrder) {
            throw new TemporaryOrderException("订单已过期");
        }

        $strategy = new \stdClass();
        switch ($tmpOrder['type']) {
            case PayOrderService::TYPE_VIP:
                $strategy = new VipStrategy();
                break;
            case PayOrderService::TYPE_RECHARGE:
                // return new Recharge();
                break;
            // ...
            default:
                throw new BusinessException('订单类型错误.');
        }


        return $strategy;
    }
}
