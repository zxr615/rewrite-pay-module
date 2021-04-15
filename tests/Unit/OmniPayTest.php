<?php


namespace Tests\Unit;

use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class OmniPayTest extends TestCase
{
    public function testCreate()
    {
        $gateway = Omnipay::create("Alipay_AopF2F");
//        $settings = $gateway->getDefaultParameters();
//        dd($settings);
        $gateway->setSignType('RSA2'); // RSA/RSA2/MD5. Use certificate mode must set RSA2
        $gateway->setAppId('the_app_id');
        $gateway->setPrivateKey('the_app_private_key');
        $gateway->setAlipayPublicKey('the_alipay_public_key'); // Need not set this when used certificate mode
        $gateway->setReturnUrl('https://www.example.com/return');
        $gateway->setNotifyUrl('https://www.example.com/notify');


        $response = $gateway->purchase()->setBizContent([
            'subject'      => 'test',
            'out_trade_no' => date('YmdHis') . mt_rand(1000, 9999),
            'total_amount' => '0.01',
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
        ])->send();

        $url = $response->getRedirectUrl();

        dd($gateway);
    }

}
