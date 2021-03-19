<?php


namespace App\Http\Services\Payment;


interface PaymentStrategy
{
    public function pay(array $order);
}
