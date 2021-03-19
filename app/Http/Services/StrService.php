<?php


namespace App\Http\Services;


use Ramsey\Uuid\Uuid;

class StrService
{
    public function getUuid()
    {
        return Uuid::uuid4()->toString();
    }
}
