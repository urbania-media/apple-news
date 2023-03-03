<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\FacebookPost;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\FacebookPost
 */
class FacebookPostTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new FacebookPost();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public static function roleProvider()
    {
        return [["facebook_post"]];
    }

    /**
     * Test the property URL
     * @test
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new FacebookPost();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public static function URLProvider()
    {
        return [["http://example.com"], ["https://example.com"]];
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
        $object = new FacebookPost();
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
        $object = new FacebookPost();
        $object->setAnimation($value);

        $this->assertEquals($value, $object->getAnimation());
    }

    /**
     * Data provider for property animation
     */
    public static function animationProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentAnimation()]];
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
        $object = new FacebookPost();
        $object->setBehavior($value);

        $this->assertEquals($value, $object->getBehavior());
    }

    /**
     * Data provider for property behavior
     */
    public static function behaviorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Behavior()]];
    }

    /**
     * Test the property conditional
     * @test
     * @dataProvider conditionalProvider
     * @covers ::getConditional
     * @covers ::setConditional
     */
    public function testPropertyConditional($value)
    {
        $object = new FacebookPost();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ConditionalComponent()]]];
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
        $object = new FacebookPost();
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
     * Test the property identifier
     * @test
     * @dataProvider identifierProvider
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testPropertyIdentifier($value)
    {
        $object = new FacebookPost();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [["a string"]];
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
        $object = new FacebookPost();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ComponentLayout()],
            ["a string"]
        ];
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
        $object = new FacebookPost();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public static function styleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyle()], ["a string"]];
    }
}
