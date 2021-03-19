<?php


namespace App\Http\Services\PayOrder;

class PayOrderContext
{
    private $strategy;

    public function __construct(PayOrderStrategy $payOrderStrategy)
    {
        return $this->strategy = $payOrderStrategy;
    }

    public function createOrder($request)
    {
        return $this->strategy->createTemporaryOrder($request);
    }

    public function preview(array $tmpOrder)
    {
        return $this->strategy->preview($tmpOrder);
    }
}
