<?php

namespace App\Http\Services\Payment;

use App\Exceptions\BusinessException;
use App\Http\Services\Payment\Strategy\AlipayStrategy;
use App\Http\Services\Payment\Strategy\UnionStrategy;
use App\Http\Services\Payment\Strategy\WechatStrategy;

class PaymentFactory
{
    public static function strategy(string $payType)
    {
        switch ($payType) {
            case 'wechat':
                $strategy = new WechatStrategy();
                break;
            case 'alipay':
                $strategy = new AlipayStrategy();
                break;
            case 'union':
                $strategy = new UnionStrategy();
                break;
            // case...
            default:
                throw new BusinessException("支付方式不存在");
        }

        return $strategy;
    }
}
