<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Aside;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Aside
 */
class AsideTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Aside();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public static function roleProvider()
    {
        return [['aside']];
    }

    /**
     * Test the property additions
     * @test
     * @dataProvider additionsProvider
     * @covers ::getAdditions
     * @covers ::setAdditions
     */
    public function testPropertyAdditions($value)
    {
        $object = new Aside();
        $object->setAdditions($value);

        $this->assertEquals($value, $object->getAdditions());
    }

    /**
     * Data provider for property additions
     */
    public static function additionsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ComponentLink()]]];
    }

    /**
     * Test the property allowAutoplacedAds
     * @test
     * @dataProvider allowAutoplacedAdsProvider
     * @covers ::getAllowAutoplacedAds
     * @covers ::setAllowAutoplacedAds
     */
    public function testPropertyAllowAutoplacedAds($value)
    {
        $object = new Aside();
        $object->setAllowAutoplacedAds($value);

        $this->assertEquals($value, $object->getAllowAutoplacedAds());
    }

    /**
     * Data provider for property allowAutoplacedAds
     */
    public static function allowAutoplacedAdsProvider()
    {
        return [[true], [false]];
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
        $object = new Aside();
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
        $object = new Aside();
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
        $object = new Aside();
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
     * Test the property components
     * @test
     * @dataProvider componentsProvider
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testPropertyComponents($value)
    {
        $object = new Aside();
        $object->setComponents($value);

        $this->assertEquals($value, $object->getComponents());
    }

    /**
     * Data provider for property components
     */
    public static function componentsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Component()]]];
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
        $object = new Aside();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ConditionalContainer()],
            [[new \Urbania\AppleNews\Format\ConditionalContainer()]],
        ];
    }

    /**
     * Test the property contentDisplay
     * @test
     * @dataProvider contentDisplayProvider
     * @covers ::getContentDisplay
     * @covers ::setContentDisplay
     */
    public function testPropertyContentDisplay($value)
    {
        $object = new Aside();
        $object->setContentDisplay($value);

        $this->assertEquals($value, $object->getContentDisplay());
    }

    /**
     * Data provider for property contentDisplay
     */
    public static function contentDisplayProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\CollectionDisplay()],
            [new \Urbania\AppleNews\Format\HorizontalStackDisplay()],
            ['none'],
        ];
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
        $object = new Aside();
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
        $object = new Aside();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [['a string']];
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
        $object = new Aside();
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
     * Test the property style
     * @test
     * @dataProvider styleProvider
     * @covers ::getStyle
     * @covers ::setStyle
     */
    public function testPropertyStyle($value)
    {
        $object = new Aside();
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
