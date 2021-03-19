<?php


namespace App\Http\Services\PayOrder\Strategy;

use App\Http\Services\PayOrder\PayOrderStrategy;
use App\Http\Services\PayOrderService;
use Illuminate\Http\Request;

// 开通 vip
class VipStrategy extends PayOrderStrategy
{
    function createTemporaryOrder(Request $request)
    {
        $packageCode = $request['code'];
        $package     = app(PayOrderService::class)->getVipByCode($packageCode);

        // 临时订单数据
        $tmpOrder = [
            'package_cope' => $package->toArray(),
            'type'         => PayOrderService::TYPE_VIP,
            'uid'          => 1,
            'ip'           => $request->ip(),
            // ....
        ];

        $tmpOrderKey = app(PayOrderService::class)->saveTemporaryOrder($tmpOrder);

        return $tmpOrderKey;
    }

    public function preview(array $tmpOrder)
    {
        $preview = [
            'title' => '开通会员',
            'price' => $tmpOrder['package_cope']['price'],
        ];

        return $preview;
    }
}
