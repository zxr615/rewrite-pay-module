<?php


namespace App\Http\Services\PayOrder;

use App\Http\Services\PayOrder\RequestEntity\Entity;

class PayOrderContext
{
    private $strategy;

    public function __construct(PayOrderStrategy $payOrderStrategy)
    {
        return $this->strategy = $payOrderStrategy;
    }

    public function createOrder(Entity $entity)
    {
        return $this->strategy->createTemporaryOrder($entity);
    }

    public function preview(array $tmpOrder)
    {
        return $this->strategy->preview($tmpOrder);
    }
}
