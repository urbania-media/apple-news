<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\AdvertisingLayout;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\AdvertisingLayout
 */
class AdvertisingLayoutTest extends TestCase
{
    /**
     * Test the property margin
     * @test
     * @dataProvider marginProvider
     * @covers ::getMargin
     * @covers ::setMargin
     */
    public function testPropertyMargin($value)
    {
        $object = new AdvertisingLayout();
        $object->setMargin($value);

        $this->assertEquals($value, $object->getMargin());
    }

    /**
     * Data provider for property margin
     */
    public function marginProvider()
    {
        return [[new \Urbania\AppleNews\Format\Margin()], [1]];
    }
}
