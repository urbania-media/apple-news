<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\MediumRectangleAdvertisement;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\MediumRectangleAdvertisement
 */
class MediumRectangleAdvertisementTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @covers ::getRole
     */
    public function testProperyRole()
    {
        $value = "medium_rectangle_advertisement";
        $object = new MediumRectangleAdvertisement();

        $this->assertEquals($value, $object->getRole());
    }
}
