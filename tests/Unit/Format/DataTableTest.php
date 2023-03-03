<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\DataTable;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\DataTable
 */
class DataTableTest extends TestCase
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
        $object = new DataTable();
        $object->setData($value);

        $this->assertEquals($value, $object->getData());
    }

    /**
     * Data provider for property data
     */
    public static function dataProvider()
    {
        return [[new \Urbania\AppleNews\Format\RecordStore()]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new DataTable();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public static function roleProvider()
    {
        return [["datatable"]];
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
        $object = new DataTable();
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
        $object = new DataTable();
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
        $object = new DataTable();
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
        $object = new DataTable();
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
     * Test the property dataOrientation
     * @test
     * @dataProvider dataOrientationProvider
     * @covers ::getDataOrientation
     * @covers ::setDataOrientation
     */
    public function testPropertyDataOrientation($value)
    {
        $object = new DataTable();
        $object->setDataOrientation($value);

        $this->assertEquals($value, $object->getDataOrientation());
    }

    /**
     * Data provider for property dataOrientation
     */
    public static function dataOrientationProvider()
    {
        return [["horizontal"], ["vertical"]];
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
        $object = new DataTable();
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
        $object = new DataTable();
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
        $object = new DataTable();
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
     * Test the property showDescriptorLabels
     * @test
     * @dataProvider showDescriptorLabelsProvider
     * @covers ::getShowDescriptorLabels
     * @covers ::setShowDescriptorLabels
     */
    public function testPropertyShowDescriptorLabels($value)
    {
        $object = new DataTable();
        $object->setShowDescriptorLabels($value);

        $this->assertEquals($value, $object->getShowDescriptorLabels());
    }

    /**
     * Data provider for property showDescriptorLabels
     */
    public static function showDescriptorLabelsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property sortBy
     * @test
     * @dataProvider sortByProvider
     * @covers ::getSortBy
     * @covers ::setSortBy
     */
    public function testPropertySortBy($value)
    {
        $object = new DataTable();
        $object->setSortBy($value);

        $this->assertEquals($value, $object->getSortBy());
    }

    /**
     * Data provider for property sortBy
     */
    public static function sortByProvider()
    {
        return [[[new \Urbania\AppleNews\Format\DataTableSorting()]]];
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
        $object = new DataTable();
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
