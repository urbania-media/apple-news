<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Records;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Records
 */
class RecordsTest extends TestCase
{
    /**
     * Test the property data
     * @test
     * @dataProvider dataProvider
     * @covers ::getData
     * @covers ::setData
     */
    public function testPropertyData($value)
    {
        $object = new Records();
        $object->setData($value);

        $this->assertEquals($value, $object->getData());
    }

    /**
     * Data provider for property data
     */
    public function dataProvider()
    {
        return [[["test" => "value"]]];
    }
}
