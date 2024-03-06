<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\MoveInAnimation;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\MoveInAnimation
 */
class MoveInAnimationTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new MoveInAnimation();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['move_in']];
    }

    /**
     * Test the property preferredStartingPosition
     * @test
     * @dataProvider preferredStartingPositionProvider
     * @covers ::getPreferredStartingPosition
     * @covers ::setPreferredStartingPosition
     */
    public function testPropertyPreferredStartingPosition($value)
    {
        $object = new MoveInAnimation();
        $object->setPreferredStartingPosition($value);

        $this->assertEquals($value, $object->getPreferredStartingPosition());
    }

    /**
     * Data provider for property preferredStartingPosition
     */
    public static function preferredStartingPositionProvider()
    {
        return [['left'], ['right']];
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
        $object = new MoveInAnimation();
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
