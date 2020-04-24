<?php

use App\Common\Model\UUID;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    public function testThat10NewUUIDAreDifferent()
    {
        $tabUUID = [];

        for ($i = 0; $i < 10; ++$i) {
            $tabUUID[] = new UUID();
        }

        foreach ($tabUUID as $uuid) {
            $matches = array_filter($tabUUID, function (UUID $e) use ($uuid) {
                return $e->equals($uuid) && $e !== $uuid;
            });

            self::assertEmpty($matches);
        }
    }

    public function test2UUIAreEquals()
    {
        $uniq = uniqid();

        $a = new UUID($uniq);
        $b = new UUID($uniq);

        self::assertTrue($a->equals($b));
    }
}
