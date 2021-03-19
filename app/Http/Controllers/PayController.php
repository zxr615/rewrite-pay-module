<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Exceptions\TemporaryOrderException;
use App\Http\Services\Payment\PaymentContext;
use App\Http\Services\Payment\PaymentFactory;
use App\Http\Services\PayOrder\PayOrderContext;
use App\Http\Services\PayOrder\PreviewFactory;
use App\Http\Services\Payment\VipStrategy;
use App\Http\Services\PayOrderService;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public const PAY_STATUS_FAIL = 0;
    public const PAY_STATUS_OK   = 1;
    public const PAY_STATUS_WAIT = 2;

    public function give($payStatus)
    {
        // 最不明确的方法, 如果没注释真不知道什么意思
        if ($payStatus == 1) {
            // ...
        }

        // 比较好的方法，即便没有注释，意思也比较明确
        if ($payStatus == self::PAY_STATUS_OK) {
            // ...
        }

        // 我更喜欢用的方法，定义一个方法，看方法名知其意
        if ($this->isPaid($payStatus)) {
            // ...
        }
    }

    // 是否已支付完成
    public function isPaid($payStatus)
    {
        return $payStatus == self::PAY_STATUS_OK;
    }

    // 开通 vip
    public function vip(Request $request)
    {
        $strategy    = new VipStrategy();
        $tmpOrderKey = (new PayOrderContext($strategy))->createOrder($request);

        return $this->data(['key' => $tmpOrderKey]);
    }

    // 预览订单接口
    public function preview(Request $request)
    {
        $tmpOrderKey = $request->get('key');

        try {
            $preview = PreviewFactory::strategy($tmpOrderKey)->preview($tmpOrderKey);
        } catch (TemporaryOrderException $e) {
            return $this->fail($e->getMessage());
        }

        return view('preview', $preview);
    }

    // 确认支付
    public function pay(Request $request)
    {
        $tmpOrderKey = $request->get('key');
        // pay_type=wechat|alipay|union
        $payType = $request->get('pay_type');

        // 处理订单数据、创建订单
        $tmpOrder = app(PayOrderService::class)->getTemporaryOrder($tmpOrderKey);
        $order    = [/** ... */];
        $created  = app(PayOrderService::class)->createOrder($order);

        if (!$created) {
            return $this->fail("支付失败, 请重新生成订单.");
        }

        // 发起支付
        try {
            // 前面我们定义了一个支付策略工厂模式，帮助我们实例化策略，所以这里传入我们的支付方式
            // 工厂就会帮我们对应支付策略返回回来，然后我们再统一调用 pay() 这个方法
            $strategy = PaymentFactory::strategy($payType);
            // 一般第三方会返回一个支付跳转链接，点击确认支付的时候用户是已经在手机页面了
            // 所以直接跳转链接就可以拉起对应的支付了。
            $url = (new PaymentContext($strategy))->pay($created);
        } catch (BusinessException $e) {
            $this->fail($e->getMessage());
        }

        // 跳转
        return redirect($url);
    }
}
