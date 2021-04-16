<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Exceptions\TemporaryOrderException;
use App\Http\Services\Payment\PaymentContext;
use App\Http\Services\Payment\PaymentFactory;
use App\Http\Services\PayOrder\Entity\VipEntity;
use App\Http\Services\PayOrder\PayOrderContext;
use App\Http\Services\PayOrder\PreviewFactory;
use App\Http\Services\PayOrder\Strategy\VipStrategy;
use App\Http\Services\PayOrderService;
use Illuminate\Http\Request;

class PayController extends Controller
{
    // 开通 vip
    // http://127.0.0.1:8000/buy/vip?code=buy_vip&buy_month=5
    public function vip(Request $request)
    {
        $vipEntity   = new VipEntity($request);
        $tmpOrderKey = (new PayOrderContext(new VipStrategy()))->createOrder($vipEntity);

        return $this->data(['key' => $tmpOrderKey]);
    }

    // 预览订单接口
    // http://127.0.0.1:8000/buy/preview?key=
    public function preview(Request $request)
    {
        $tmpOrderKey = $request->get('key');
        $tmpOrder    = app(PayOrderService::class)->getTemporaryOrder($tmpOrderKey);

        try {
            $preview = PreviewFactory::strategy($tmpOrderKey)->preview($tmpOrder);
        } catch (TemporaryOrderException $e) {
            return $this->fail($e->getMessage());
        }

        dd($preview);
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
