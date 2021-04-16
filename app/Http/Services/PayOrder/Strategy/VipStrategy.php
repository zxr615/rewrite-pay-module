<?php


namespace App\Http\Services\PayOrder\Strategy;

use App\Http\Services\PayOrder\Entity\Entity;
use App\Http\Services\PayOrder\PayOrderStrategy;
use App\Http\Services\PayOrderService;

// 开通 vip
class VipStrategy extends PayOrderStrategy
{
    function createTemporaryOrder(Entity $entity)
    {
        // 临时订单数据
        $tmpOrder = [
            'package_cope' => $entity->getPackageCope(),
            'type'         => PayOrderService::TYPE_VIP,
            'uid'          => $entity->getUid(),
            'ip'           => $entity->getIp(),
            'buy_month'    => $entity->getBuyMonth()
            // ....
        ];

        $tmpOrderKey = app(PayOrderService::class)->saveTemporaryOrder($tmpOrder);

        return $tmpOrderKey;
    }

    public function preview(array $tmpOrder)
    {
        $packageCope = json_decode($tmpOrder['package_cope'], true);
        $preview     = [
            'title' => '开通会员',
            'price' => $packageCope['price'],
        ];

        return $preview;
    }
}
