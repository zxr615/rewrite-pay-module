<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;

class OldPayController extends Controller
{
    // 获取二维码接口
    public function qrcode(Request $request)
    {
        try {
            $key = $this->checkVerifyType(0, 1);
            return $key;
        } catch (\Exception $e) {
            return '下单失败';
        }
    }

    // 手机扫码后显示订单信息页面
    public function show()
    {
        $key = \request()->get('key');
        $data = Redis::get($key);

        return view('confirm', $data);
    }


private function checkVerifyType($payType1 = 0, $payType2 = 0)
{
    $data = request()->all();

    if (!ctype_digit(strval($data['type']))) {
        throw new \Exception('type err');
    }

    switch ($data['type']) {
        case 'vip':
            // ... 验证
            $data['vip_info'] = Vip::where('code', $data['code'])->first();
            break;
        case 'recharge':
            // ... 验证
            $data['money'] = $data['money'];
            break;
        // case...
    }

    // 优惠券判断
    if ($data['coupon_id']) {
        $money = Coupon::where('id', $data['coupon_id'])->value("money");
        $data['reduce'] = $money;
        // ....
    }

    // 订单预览信息
    $data['show_title'] = "购买一个会员";
    $data['show_money'] = 100;
    $key = "abcdefg";
    Redis::set($key, $data);

    return $key;
}
}
