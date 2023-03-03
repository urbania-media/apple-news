<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Meta;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Meta
 */
class MetaTest extends TestCase
{
    /**
     * Test the property throttling
     * @test
     * @dataProvider throttlingProvider
     * @covers ::getThrottling
     * @covers ::setThrottling
     */
    public function testPropertyThrottling($value)
    {
        $object = new Meta();
        $object->setThrottling($value);

        $this->assertEquals($value, $object->getThrottling());
    }

    /**
     * Data provider for property throttling
     */
    public static function throttlingProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\Throttling()]];
    }
}
