<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Ramsey\Uuid\Uuid;

class PayOrderService
{
    const TYPE_VIP      = 1; // 购买 vip
    const TYPE_RECHARGE = 2; // 充值
    const TYPE_GOODS    = 3; // 购买商品

    // 通过 code 查询 vip 套餐信息
    public function getVipByCode(string $code)
    {
        // 这里应是从数据库获取数据返回
        return collect(['id' => 1, 'code' => 'vip1', 'price' => 100, 'vip_day' => 30])->toJson();
    }

    // 保存临时订单
    public function saveTemporaryOrder(array $tmpOrder)
    {
        $key = Uuid::uuid4()->toString();
        Cache::put($key, $tmpOrder, 1800);

        return $key;
    }

    // 获取临时订单
    public function getTemporaryOrder(string $key)
    {
        return Cache::get($key);
    }

    // 创建订单
    public function createOrder(array $order)
    {
        return Order::Create($order);
    }

}
