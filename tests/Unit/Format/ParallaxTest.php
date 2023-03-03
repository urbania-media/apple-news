<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Parallax;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Parallax
 */
class ParallaxTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new Parallax();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [["parallax"]];
    }

    /**
     * Test the property factor
     * @test
     * @dataProvider factorProvider
     * @covers ::getFactor
     * @covers ::setFactor
     */
    public function testPropertyFactor($value)
    {
        $object = new Parallax();
        $object->setFactor($value);

        $this->assertEquals($value, $object->getFactor());
    }

    /**
     * Data provider for property factor
     */
    public static function factorProvider()
    {
        return [[1.1], [1]];
    }
}
