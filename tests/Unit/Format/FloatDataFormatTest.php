<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\FloatDataFormat;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\FloatDataFormat
 */
class FloatDataFormatTest extends TestCase
{
    /**
     * Test the property decimals
     * @test
     * @dataProvider decimalsProvider
     * @covers ::getDecimals
     * @covers ::setDecimals
     */
    public function testPropertyDecimals($value)
    {
        $object = new FloatDataFormat();
        $object->setDecimals($value);

        $this->assertEquals($value, $object->getDecimals());
    }

    /**
     * Data provider for property decimals
     */
    public static function decimalsProvider()
    {
        return [[1]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new FloatDataFormat();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['float']];
    }
}
