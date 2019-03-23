<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ParallaxScaleHeader;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ParallaxScaleHeader
 */
class ParallaxScaleHeaderTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @covers ::getType
     */
    public function testProperyType()
    {
        $value = "parallax_scale";
        $object = new ParallaxScaleHeader();

        $this->assertEquals($value, $object->getType());
    }
}
