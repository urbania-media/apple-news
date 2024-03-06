<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\CollectionDisplay;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\CollectionDisplay
 */
class CollectionDisplayTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new CollectionDisplay();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['collection']];
    }

    /**
     * Test the property alignment
     * @test
     * @dataProvider alignmentProvider
     * @covers ::getAlignment
     * @covers ::setAlignment
     */
    public function testPropertyAlignment($value)
    {
        $object = new CollectionDisplay();
        $object->setAlignment($value);

        $this->assertEquals($value, $object->getAlignment());
    }

    /**
     * Data provider for property alignment
     */
    public static function alignmentProvider()
    {
        return [['left'], ['center'], ['right']];
    }

    /**
     * Test the property distribution
     * @test
     * @dataProvider distributionProvider
     * @covers ::getDistribution
     * @covers ::setDistribution
     */
    public function testPropertyDistribution($value)
    {
        $object = new CollectionDisplay();
        $object->setDistribution($value);

        $this->assertEquals($value, $object->getDistribution());
    }

    /**
     * Data provider for property distribution
     */
    public static function distributionProvider()
    {
        return [['wide'], ['narrow']];
    }

    /**
     * Test the property gutter
     * @test
     * @dataProvider gutterProvider
     * @covers ::getGutter
     * @covers ::setGutter
     */
    public function testPropertyGutter($value)
    {
        $object = new CollectionDisplay();
        $object->setGutter($value);

        $this->assertEquals($value, $object->getGutter());
    }

    /**
     * Data provider for property gutter
     */
    public static function gutterProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property maximumWidth
     * @test
     * @dataProvider maximumWidthProvider
     * @covers ::getMaximumWidth
     * @covers ::setMaximumWidth
     */
    public function testPropertyMaximumWidth($value)
    {
        $object = new CollectionDisplay();
        $object->setMaximumWidth($value);

        $this->assertEquals($value, $object->getMaximumWidth());
    }

    /**
     * Data provider for property maximumWidth
     */
    public static function maximumWidthProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property minimumWidth
     * @test
     * @dataProvider minimumWidthProvider
     * @covers ::getMinimumWidth
     * @covers ::setMinimumWidth
     */
    public function testPropertyMinimumWidth($value)
    {
        $object = new CollectionDisplay();
        $object->setMinimumWidth($value);

        $this->assertEquals($value, $object->getMinimumWidth());
    }

    /**
     * Data provider for property minimumWidth
     */
    public static function minimumWidthProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property rowSpacing
     * @test
     * @dataProvider rowSpacingProvider
     * @covers ::getRowSpacing
     * @covers ::setRowSpacing
     */
    public function testPropertyRowSpacing($value)
    {
        $object = new CollectionDisplay();
        $object->setRowSpacing($value);

        $this->assertEquals($value, $object->getRowSpacing());
    }

    /**
     * Data provider for property rowSpacing
     */
    public static function rowSpacingProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property variableSizing
     * @test
     * @dataProvider variableSizingProvider
     * @covers ::getVariableSizing
     * @covers ::setVariableSizing
     */
    public function testPropertyVariableSizing($value)
    {
        $object = new CollectionDisplay();
        $object->setVariableSizing($value);

        $this->assertEquals($value, $object->getVariableSizing());
    }

    /**
     * Data provider for property variableSizing
     */
    public static function variableSizingProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property widows
     * @test
     * @dataProvider widowsProvider
     * @covers ::getWidows
     * @covers ::setWidows
     */
    public function testPropertyWidows($value)
    {
        $object = new CollectionDisplay();
        $object->setWidows($value);

        $this->assertEquals($value, $object->getWidows());
    }

    /**
     * Data provider for property widows
     */
    public static function widowsProvider()
    {
        return [['equalize'], ['optimize'], ['allow']];
    }
}
