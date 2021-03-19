<?php

namespace App\Http\Services\Payment\Strategy;

use App\Http\Services\Payment\PaymentStrategy;

class WechatStrategy implements PaymentStrategy
{
    public function pay(array $order)
    {
        /**
         *
         * @see 微信官方 https://github.com/wechatpay-apiv3/wechatpay-guzzle-middleware
         * @see 官方文档 https://pay.weixin.qq.com/wiki/doc/apiv3/open/pay/chapter2_6_2.shtml
         * @see 第三方sdk https://github.com/lokielse/omnipay-wechatpay
         */

        return "https://pay.weixin.qq.com/";
    }
}
