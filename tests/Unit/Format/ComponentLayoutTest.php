<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ComponentLayout;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ComponentLayout
 */
class ComponentLayoutTest extends TestCase
{
    /**
     * Test the property columnSpan
     * @test
     * @dataProvider columnSpanProvider
     * @covers ::getColumnSpan
     * @covers ::setColumnSpan
     */
    public function testPropertyColumnSpan($value)
    {
        $object = new ComponentLayout();
        $object->setColumnSpan($value);

        $this->assertEquals($value, $object->getColumnSpan());
    }

    /**
     * Data provider for property columnSpan
     */
    public static function columnSpanProvider()
    {
        return [[1]];
    }

    /**
     * Test the property columnStart
     * @test
     * @dataProvider columnStartProvider
     * @covers ::getColumnStart
     * @covers ::setColumnStart
     */
    public function testPropertyColumnStart($value)
    {
        $object = new ComponentLayout();
        $object->setColumnStart($value);

        $this->assertEquals($value, $object->getColumnStart());
    }

    /**
     * Data provider for property columnStart
     */
    public static function columnStartProvider()
    {
        return [[1]];
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
        $object = new ComponentLayout();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ConditionalComponentLayout()],
            [[new \Urbania\AppleNews\Format\ConditionalComponentLayout()]],
        ];
    }

    /**
     * Test the property horizontalContentAlignment
     * @test
     * @dataProvider horizontalContentAlignmentProvider
     * @covers ::getHorizontalContentAlignment
     * @covers ::setHorizontalContentAlignment
     */
    public function testPropertyHorizontalContentAlignment($value)
    {
        $object = new ComponentLayout();
        $object->setHorizontalContentAlignment($value);

        $this->assertEquals($value, $object->getHorizontalContentAlignment());
    }

    /**
     * Data provider for property horizontalContentAlignment
     */
    public static function horizontalContentAlignmentProvider()
    {
        return [['left'], ['center'], ['right']];
    }

    /**
     * Test the property ignoreDocumentGutter
     * @test
     * @dataProvider ignoreDocumentGutterProvider
     * @covers ::getIgnoreDocumentGutter
     * @covers ::setIgnoreDocumentGutter
     */
    public function testPropertyIgnoreDocumentGutter($value)
    {
        $object = new ComponentLayout();
        $object->setIgnoreDocumentGutter($value);

        $this->assertEquals($value, $object->getIgnoreDocumentGutter());
    }

    /**
     * Data provider for property ignoreDocumentGutter
     */
    public static function ignoreDocumentGutterProvider()
    {
        return [['none'], ['left'], ['right'], ['both'], [true], [false]];
    }

    /**
     * Test the property ignoreDocumentMargin
     * @test
     * @dataProvider ignoreDocumentMarginProvider
     * @covers ::getIgnoreDocumentMargin
     * @covers ::setIgnoreDocumentMargin
     */
    public function testPropertyIgnoreDocumentMargin($value)
    {
        $object = new ComponentLayout();
        $object->setIgnoreDocumentMargin($value);

        $this->assertEquals($value, $object->getIgnoreDocumentMargin());
    }

    /**
     * Data provider for property ignoreDocumentMargin
     */
    public static function ignoreDocumentMarginProvider()
    {
        return [['none'], ['left'], ['right'], ['both'], [true], [false]];
    }

    /**
     * Test the property ignoreViewportPadding
     * @test
     * @dataProvider ignoreViewportPaddingProvider
     * @covers ::getIgnoreViewportPadding
     * @covers ::setIgnoreViewportPadding
     */
    public function testPropertyIgnoreViewportPadding($value)
    {
        $object = new ComponentLayout();
        $object->setIgnoreViewportPadding($value);

        $this->assertEquals($value, $object->getIgnoreViewportPadding());
    }

    /**
     * Data provider for property ignoreViewportPadding
     */
    public static function ignoreViewportPaddingProvider()
    {
        return [['none'], ['left'], ['right'], ['both'], [true], [false]];
    }

    /**
     * Test the property margin
     * @test
     * @dataProvider marginProvider
     * @covers ::getMargin
     * @covers ::setMargin
     */
    public function testPropertyMargin($value)
    {
        $object = new ComponentLayout();
        $object->setMargin($value);

        $this->assertEquals($value, $object->getMargin());
    }

    /**
     * Data provider for property margin
     */
    public static function marginProvider()
    {
        return [[new \Urbania\AppleNews\Format\Margin()], [1]];
    }

    /**
     * Test the property maximumContentWidth
     * @test
     * @dataProvider maximumContentWidthProvider
     * @covers ::getMaximumContentWidth
     * @covers ::setMaximumContentWidth
     */
    public function testPropertyMaximumContentWidth($value)
    {
        $object = new ComponentLayout();
        $object->setMaximumContentWidth($value);

        $this->assertEquals($value, $object->getMaximumContentWidth());
    }

    /**
     * Data provider for property maximumContentWidth
     */
    public static function maximumContentWidthProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property minimumHeight
     * @test
     * @dataProvider minimumHeightProvider
     * @covers ::getMinimumHeight
     * @covers ::setMinimumHeight
     */
    public function testPropertyMinimumHeight($value)
    {
        $object = new ComponentLayout();
        $object->setMinimumHeight($value);

        $this->assertEquals($value, $object->getMinimumHeight());
    }

    /**
     * Data provider for property minimumHeight
     */
    public static function minimumHeightProvider()
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
        $object = new ComponentLayout();
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
     * Test the property maximumWidth
     * @test
     * @dataProvider maximumWidthProvider
     * @covers ::getMaximumWidth
     * @covers ::setMaximumWidth
     */
    public function testPropertyMaximumWidth($value)
    {
        $object = new ComponentLayout();
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
     * Test the property padding
     * @test
     * @dataProvider paddingProvider
     * @covers ::getPadding
     * @covers ::setPadding
     */
    public function testPropertyPadding($value)
    {
        $object = new ComponentLayout();
        $object->setPadding($value);

        $this->assertEquals($value, $object->getPadding());
    }

    /**
     * Data provider for property padding
     */
    public static function paddingProvider()
    {
        return [[new \Urbania\AppleNews\Format\Padding()], ['1vh'], [1], ['1vmin'], [1.1], [1]];
    }
}
