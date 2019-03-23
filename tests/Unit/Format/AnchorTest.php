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
     * @covers ::getOriginAnchorPosition
     * @covers ::setOriginAnchorPosition
     */
    public function testProperyOriginAnchorPosition()
    {
        $value = "center";
        $object = new Anchor();
        $object->setOriginAnchorPosition($value);

        $this->assertEquals($value, $object->getOriginAnchorPosition());
    }

    /**
     * Test the property rangeLength
     * @test
     * @covers ::getRangeLength
     * @covers ::setRangeLength
     */
    public function testProperyRangeLength()
    {
        $value = 1;
        $object = new Anchor();
        $object->setRangeLength($value);

        $this->assertEquals($value, $object->getRangeLength());
    }

    /**
     * Test the property rangeStart
     * @test
     * @covers ::getRangeStart
     * @covers ::setRangeStart
     */
    public function testProperyRangeStart()
    {
        $value = 1;
        $object = new Anchor();
        $object->setRangeStart($value);

        $this->assertEquals($value, $object->getRangeStart());
    }

    /**
     * Test the property target
     * @test
     * @covers ::getTarget
     * @covers ::setTarget
     */
    public function testProperyTarget()
    {
        $value = "a string";
        $object = new Anchor();
        $object->setTarget($value);

        $this->assertEquals($value, $object->getTarget());
    }

    /**
     * Test the property targetAnchorPosition
     * @test
     * @covers ::getTargetAnchorPosition
     * @covers ::setTargetAnchorPosition
     */
    public function testProperyTargetAnchorPosition()
    {
        $value = "top";
        $object = new Anchor();
        $object->setTargetAnchorPosition($value);

        $this->assertEquals($value, $object->getTargetAnchorPosition());
    }

    /**
     * Test the property targetComponentIdentifier
     * @test
     * @covers ::getTargetComponentIdentifier
     * @covers ::setTargetComponentIdentifier
     */
    public function testProperyTargetComponentIdentifier()
    {
        $value = "a string";
        $object = new Anchor();
        $object->setTargetComponentIdentifier($value);

        $this->assertEquals($value, $object->getTargetComponentIdentifier());
    }
}
