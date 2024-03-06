<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalDivider;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalDivider
 */
class ConditionalDividerTest extends TestCase
{
    /**
     * Test the property conditions
     * @test
     * @dataProvider conditionsProvider
     * @covers ::getConditions
     * @covers ::setConditions
     */
    public function testPropertyConditions($value)
    {
        $object = new ConditionalDivider();
        $object->setConditions($value);

        $this->assertEquals($value, $object->getConditions());
    }

    /**
     * Data provider for property conditions
     */
    public static function conditionsProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\Condition()],
            [[new \Urbania\AppleNews\Format\Condition()]],
        ];
    }

    /**
     * Test the property anchor
     * @test
     * @dataProvider anchorProvider
     * @covers ::getAnchor
     * @covers ::setAnchor
     */
    public function testPropertyAnchor($value)
    {
        $object = new ConditionalDivider();
        $object->setAnchor($value);

        $this->assertEquals($value, $object->getAnchor());
    }

    /**
     * Data provider for property anchor
     */
    public static function anchorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Anchor()]];
    }

    /**
     * Test the property animation
     * @test
     * @dataProvider animationProvider
     * @covers ::getAnimation
     * @covers ::setAnimation
     */
    public function testPropertyAnimation($value)
    {
        $object = new ConditionalDivider();
        $object->setAnimation($value);

        $this->assertEquals($value, $object->getAnimation());
    }

    /**
     * Data provider for property animation
     */
    public static function animationProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentAnimation()], ['none']];
    }

    /**
     * Test the property behavior
     * @test
     * @dataProvider behaviorProvider
     * @covers ::getBehavior
     * @covers ::setBehavior
     */
    public function testPropertyBehavior($value)
    {
        $object = new ConditionalDivider();
        $object->setBehavior($value);

        $this->assertEquals($value, $object->getBehavior());
    }

    /**
     * Data provider for property behavior
     */
    public static function behaviorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Behavior()], ['none']];
    }

    /**
     * Test the property hidden
     * @test
     * @dataProvider hiddenProvider
     * @covers ::getHidden
     * @covers ::setHidden
     */
    public function testPropertyHidden($value)
    {
        $object = new ConditionalDivider();
        $object->setHidden($value);

        $this->assertEquals($value, $object->getHidden());
    }

    /**
     * Data provider for property hidden
     */
    public static function hiddenProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property layout
     * @test
     * @dataProvider layoutProvider
     * @covers ::getLayout
     * @covers ::setLayout
     */
    public function testPropertyLayout($value)
    {
        $object = new ConditionalDivider();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentLayout()], ['a string']];
    }

    /**
     * Test the property stroke
     * @test
     * @dataProvider strokeProvider
     * @covers ::getStroke
     * @covers ::setStroke
     */
    public function testPropertyStroke($value)
    {
        $object = new ConditionalDivider();
        $object->setStroke($value);

        $this->assertEquals($value, $object->getStroke());
    }

    /**
     * Data provider for property stroke
     */
    public static function strokeProvider()
    {
        return [[new \Urbania\AppleNews\Format\StrokeStyle()], ['none']];
    }

    /**
     * Test the property style
     * @test
     * @dataProvider styleProvider
     * @covers ::getStyle
     * @covers ::setStyle
     */
    public function testPropertyStyle($value)
    {
        $object = new ConditionalDivider();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public static function styleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyle()], ['a string'], ['none']];
    }
}
