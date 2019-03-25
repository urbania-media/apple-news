<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\FadeInAnimation;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\FadeInAnimation
 */
class FadeInAnimationTest extends TestCase
{
    /**
     * Test the property initialAlpha
     * @test
     * @dataProvider initialAlphaProvider
     * @covers ::getInitialAlpha
     * @covers ::setInitialAlpha
     */
    public function testPropertyInitialAlpha($value)
    {
        $object = new FadeInAnimation();
        $object->setInitialAlpha($value);

        $this->assertEquals($value, $object->getInitialAlpha());
    }

    /**
     * Data provider for property initialAlpha
     */
    public function initialAlphaProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new FadeInAnimation();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["fade_in"]];
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
        $object = new FadeInAnimation();
        $object->setUserControllable($value);

        $this->assertEquals($value, $object->getUserControllable());
    }

    /**
     * Data provider for property userControllable
     */
    public function userControllableProvider()
    {
        return [[true], [false]];
    }
}
