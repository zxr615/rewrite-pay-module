<?php

namespace App\Http\Services\PayOrder;

use App\Exceptions\UnsupportedOperationException;
use Illuminate\Http\Request;

abstract class PayOrderStrategy
{
    // 创建临时订单
    abstract function createTemporaryOrder(Request $request);

    // 预览订单
    public function preview(array $tmpOrder)
    {
        throw new UnsupportedOperationException("不支持的方法");
    }



}
