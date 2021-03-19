<?php

namespace App\Http\Services\Payment;


class PaymentContext
{
    private $strategy;

    public function __construct(PaymentStrategy $paymentStrategy)
    {
        return $this->strategy = $paymentStrategy;
    }

    public function pay(array $order)
    {
        return $this->strategy->pay($order);
    }
}
