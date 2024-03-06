<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ScaleFadeAnimation;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ScaleFadeAnimation
 */
class ScaleFadeAnimationTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new ScaleFadeAnimation();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['scale_fade']];
    }

    /**
     * Test the property initialAlpha
     * @test
     * @dataProvider initialAlphaProvider
     * @covers ::getInitialAlpha
     * @covers ::setInitialAlpha
     */
    public function testPropertyInitialAlpha($value)
    {
        $object = new ScaleFadeAnimation();
        $object->setInitialAlpha($value);

        $this->assertEquals($value, $object->getInitialAlpha());
    }

    /**
     * Data provider for property initialAlpha
     */
    public static function initialAlphaProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property initialScale
     * @test
     * @dataProvider initialScaleProvider
     * @covers ::getInitialScale
     * @covers ::setInitialScale
     */
    public function testPropertyInitialScale($value)
    {
        $object = new ScaleFadeAnimation();
        $object->setInitialScale($value);

        $this->assertEquals($value, $object->getInitialScale());
    }

    /**
     * Data provider for property initialScale
     */
    public static function initialScaleProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property userControllable
     * @test
     * @dataProvider userControllableProvider
     * @covers ::getUserControllable
     * @covers ::setUserControllable
     */
    public function testPropertyUserControllable($value)
    {
        $object = new ScaleFadeAnimation();
        $object->setUserControllable($value);

        $this->assertEquals($value, $object->getUserControllable());
    }

    /**
     * Data provider for property userControllable
     */
    public static function userControllableProvider()
    {
        return [[true], [false]];
    }
}
