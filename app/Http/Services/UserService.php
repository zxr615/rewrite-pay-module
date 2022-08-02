<?php

namespace App\Http\Services;

use Illuminate\Support\Str;

class UserService
{
    // 用户当日是否已经签到
    // 模拟如果等于 1 则已签到
    public function todayIsSinIn(): bool
    {
        return rand(0, 1) == 1;
    }
}
