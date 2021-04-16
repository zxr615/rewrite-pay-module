<?php


namespace App\Http\Services\PayOrder\Entity;

class VipEntity extends Entity
{
    // 开通vip月数
    protected $buyMonth;

    public function getBuyMonth() { return $this->buyMonth;}
    public function setBuyMonth($buyMonth){ $this->buyMonth = $buyMonth;}
}
