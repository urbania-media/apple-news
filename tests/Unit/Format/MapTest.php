<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Map;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Map
 */
class MapTest extends TestCase
{
    /**
     * Test the property latitude
     * @test
     * @dataProvider latitudeProvider
     * @covers ::getLatitude
     * @covers ::setLatitude
     */
    public function testPropertyLatitude($value)
    {
        $object = new Map();
        $object->setLatitude($value);

        $this->assertEquals($value, $object->getLatitude());
    }

    /**
     * Data provider for property latitude
     */
    public function latitudeProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property longitude
     * @test
     * @dataProvider longitudeProvider
     * @covers ::getLongitude
     * @covers ::setLongitude
     */
    public function testPropertyLongitude($value)
    {
        $object = new Map();
        $object->setLongitude($value);

        $this->assertEquals($value, $object->getLongitude());
    }

    /**
     * Data provider for property longitude
     */
    public function longitudeProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Map();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["map"]];
    }

    /**
     * Test the property accessibilityCaption
     * @test
     * @dataProvider accessibilityCaptionProvider
     * @covers ::getAccessibilityCaption
     * @covers ::setAccessibilityCaption
     */
    public function testPropertyAccessibilityCaption($value)
    {
        $object = new Map();
        $object->setAccessibilityCaption($value);

        $this->assertEquals($value, $object->getAccessibilityCaption());
    }

    /**
     * Data provider for property accessibilityCaption
     */
    public function accessibilityCaptionProvider()
    {
        return [["a string"]];
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
        $object = new Map();
        $object->setAnchor($value);

        $this->assertEquals($value, $object->getAnchor());
    }

    /**
     * Data provider for property anchor
     */
    public function anchorProvider()
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
        $object = new Map();
        $object->setAnimation($value);

        $this->assertEquals($value, $object->getAnimation());
    }

    /**
     * Data provider for property animation
     */
    public function animationProvider()
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
        $object = new Map();
        $object->setBehavior($value);

        $this->assertEquals($value, $object->getBehavior());
    }

    /**
     * Data provider for property behavior
     */
    public function behaviorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Behavior()]];
    }

    /**
     * Test the property caption
     * @test
     * @dataProvider captionProvider
     * @covers ::getCaption
     * @covers ::setCaption
     */
    public function testPropertyCaption($value)
    {
        $object = new Map();
        $object->setCaption($value);

        $this->assertEquals($value, $object->getCaption());
    }

    /**
     * Data provider for property caption
     */
    public function captionProvider()
    {
        return [["a string"]];
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
        $object = new Map();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public function conditionalProvider()
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
        $object = new Map();
        $object->setHidden($value);

        $this->assertEquals($value, $object->getHidden());
    }

    /**
     * Data provider for property hidden
     */
    public function hiddenProvider()
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
        $object = new Map();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public function identifierProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property items
     * @test
     * @dataProvider itemsProvider
     * @covers ::getItems
     * @covers ::setItems
     */
    public function testPropertyItems($value)
    {
        $object = new Map();
        $object->setItems($value);

        $this->assertEquals($value, $object->getItems());
    }

    /**
     * Data provider for property items
     */
    public function itemsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\MapItem()]]];
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
        $object = new Map();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public function layoutProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ComponentLayout()],
            ["a string"]
        ];
    }

    /**
     * Test the property mapType
     * @test
     * @dataProvider mapTypeProvider
     * @covers ::getMapType
     * @covers ::setMapType
     */
    public function testPropertyMapType($value)
    {
        $object = new Map();
        $object->setMapType($value);

        $this->assertEquals($value, $object->getMapType());
    }

    /**
     * Data provider for property mapType
     */
    public function mapTypeProvider()
    {
        return [["standard"], ["hybrid"], ["satellite"]];
    }

    /**
     * Test the property span
     * @test
     * @dataProvider spanProvider
     * @covers ::getSpan
     * @covers ::setSpan
     */
    public function testPropertySpan($value)
    {
        $object = new Map();
        $object->setSpan($value);

        $this->assertEquals($value, $object->getSpan());
    }

    /**
     * Data provider for property span
     */
    public function spanProvider()
    {
        return [[new \Urbania\AppleNews\Format\MapSpan()]];
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
        $object = new Map();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public function styleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyle()], ["a string"]];
    }
}
