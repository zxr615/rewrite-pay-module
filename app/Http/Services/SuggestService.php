<?php


namespace App\Http\Services;


class SuggestService
{
    public const PAY_STATUS_FAIL = 0;
    public const PAY_STATUS_OK   = 1;
    public const PAY_STATUS_WAIT = 2;

    public function give($payStatus)
    {
        // 最不明确的方法, 如果没注释真不知道什么意思
        if ($payStatus == 1) {
            // ...
        }

        // 比较好的方法，即便没有注释，意思也比较明确
        if ($payStatus == self::PAY_STATUS_OK) {
            // ...
        }

        // 我更喜欢用的方法，定义一个方法，看方法名知其意
        if ($this->isPaid($payStatus)) {
            // ...
        }
    }

    // 是否已支付完成
    public function isPaid($payStatus)
    {
        return $payStatus == self::PAY_STATUS_OK;
    }
}
