<?php


namespace Tests\Benchmark;


use App\Http\Services\PayOrderService;
use Ramsey\Uuid\Uuid;

class Test
{
    public function benchTest()
    {
        usleep(300);
    }

    public function benchUuid()
    {
        Uuid::uuid4()->toString();
    }

    public function benchHashMd5()
    {
        $tmpOrder = [
            'package_cope' => '{"id":1,"code":"vip1","price":100,"vip_day":30}',
            'type'         => PayOrderService::TYPE_VIP,
            'uid'          => 1,
            'ip'           => '127.0.0.1',
            'time'         => microtime(true)
        ];
        $md5Hash = hash('md5', implode("", $tmpOrder));
    }
}
