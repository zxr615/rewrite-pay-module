<?php

namespace App\Http\Services\PayOrder\Entity;

use App\Http\Services\PayOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

abstract class Entity
{
    protected $ip;
    protected $packageCope;
    protected $code;
    protected $uid;
    protected $type;

    public function __construct(Request $request)
    {
        $this->ip          = $request->getClientIp();
        $this->code        = $request->get('code');
        $this->uid         = Auth::id();
        $this->packageCope = app(PayOrderService::class)->getVipByCode($this->code);

        // 为成员方法 `set` 值
        foreach ($request->all() as $fields => $value) {
            $property = 'set' . Str::studly($fields);
            if (property_exists($this, $fields)) {
                $this->$property = $value;
            }
        }
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPackageCope()
    {
        return $this->packageCope;
    }

    public function setPackageCope($packageCope)
    {
        $this->packageCope = $packageCope;
    }
}
