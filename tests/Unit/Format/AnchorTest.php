<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Anchor;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Anchor
 */
class AnchorTest extends TestCase
{
    /**
     * Test the property originAnchorPosition
     * @test
     * @dataProvider originAnchorPositionProvider
     * @covers ::getOriginAnchorPosition
     * @covers ::setOriginAnchorPosition
     */
    public function testPropertyOriginAnchorPosition($value)
    {
        $object = new Anchor();
        $object->setOriginAnchorPosition($value);

        $this->assertEquals($value, $object->getOriginAnchorPosition());
    }

    /**
     * Data provider for property originAnchorPosition
     */
    public function originAnchorPositionProvider()
    {
        return [["top"], ["center"], ["bottom"]];
    }

    /**
     * Test the property rangeLength
     * @test
     * @dataProvider rangeLengthProvider
     * @covers ::getRangeLength
     * @covers ::setRangeLength
     */
    public function testPropertyRangeLength($value)
    {
        $object = new Anchor();
        $object->setRangeLength($value);

        $this->assertEquals($value, $object->getRangeLength());
    }

    /**
     * Data provider for property rangeLength
     */
    public function rangeLengthProvider()
    {
        return [[1]];
    }

    /**
     * Test the property rangeStart
     * @test
     * @dataProvider rangeStartProvider
     * @covers ::getRangeStart
     * @covers ::setRangeStart
     */
    public function testPropertyRangeStart($value)
    {
        $object = new Anchor();
        $object->setRangeStart($value);

        $this->assertEquals($value, $object->getRangeStart());
    }

    /**
     * Data provider for property rangeStart
     */
    public function rangeStartProvider()
    {
        return [[1]];
    }

    /**
     * Test the property target
     * @test
     * @dataProvider targetProvider
     * @covers ::getTarget
     * @covers ::setTarget
     */
    public function testPropertyTarget($value)
    {
        $object = new Anchor();
        $object->setTarget($value);

        $this->assertEquals($value, $object->getTarget());
    }

    /**
     * Data provider for property target
     */
    public function targetProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property targetAnchorPosition
     * @test
     * @dataProvider targetAnchorPositionProvider
     * @covers ::getTargetAnchorPosition
     * @covers ::setTargetAnchorPosition
     */
    public function testPropertyTargetAnchorPosition($value)
    {
        $object = new Anchor();
        $object->setTargetAnchorPosition($value);

        $this->assertEquals($value, $object->getTargetAnchorPosition());
    }

    /**
     * Data provider for property targetAnchorPosition
     */
    public function targetAnchorPositionProvider()
    {
        return [["top"], ["center"], ["bottom"]];
    }

    /**
     * Test the property targetComponentIdentifier
     * @test
     * @dataProvider targetComponentIdentifierProvider
     * @covers ::getTargetComponentIdentifier
     * @covers ::setTargetComponentIdentifier
     */
    public function testPropertyTargetComponentIdentifier($value)
    {
        $object = new Anchor();
        $object->setTargetComponentIdentifier($value);

        $this->assertEquals($value, $object->getTargetComponentIdentifier());
    }

    /**
     * Data provider for property targetComponentIdentifier
     */
    public function targetComponentIdentifierProvider()
    {
        return [["a string"]];
    }
}
