<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        for ($i = 0; $i < 10; $i++) {
            echo microtime(true);
            echo PHP_EOL;
        }

        for ($i = 0; $i < 10; $i++) {
            echo Uuid::uuid4()->toString();
            echo PHP_EOL;
        }


        $this->assertTrue(true);
    }
}
