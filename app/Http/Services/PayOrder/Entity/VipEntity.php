<?php


namespace App\Http\Services\PayOrder\Entity;


class VipEntity extends Entity
{
    protected $buyMonth;

    /**
     * @return mixed
     */
    public function getBuyMonth()
    {
        return $this->buyMonth;
    }

    /**
     * @param mixed $buyMonth
     */
    public function setBuyMonth($buyMonth): void
    {
        $this->buyMonth = $buyMonth;
    }

}
