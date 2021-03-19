<?php

namespace App\Http\Services\Payment\Strategy;


use App\Http\Services\Payment\PaymentStrategy;

class AlipayStrategy implements PaymentStrategy
{
    public function pay(array $order)
    {
        /**
         * 向支付宝请求
         * @see 支付宝官方sdk https://github.com/alipay/alipay-easysdk/tree/master/php
         * @see 第三方sdk https://github.com/lokielse/omnipay-alipay
         */

        return "https://www.alipay.com/";
    }
}
