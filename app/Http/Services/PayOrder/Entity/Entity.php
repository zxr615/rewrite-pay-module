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

        foreach ($request->all() as $fields => $value) {
            $property = 'set' . Str::studly($fields);
            if (property_exists($this, $fields)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * @return string|\Symfony\Component\HttpFoundation\string|null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string|\Symfony\Component\HttpFoundation\string|null $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPackageCope()
    {
        return $this->packageCope;
    }

    /**
     * @param string $packageCope
     */
    public function setPackageCope(string $packageCope): void
    {
        $this->packageCope = $packageCope;
    }
}
