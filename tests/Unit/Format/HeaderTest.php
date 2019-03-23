<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Header;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Header
 */
class HeaderTest extends TestCase
{
    /**
     * Test the property components
     * @test
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testProperyComponents()
    {
        $value = [];
        $object = new Header();
        $object->setComponents($value);

        $this->assertEquals($value, $object->getComponents());
    }

    /**
     * Test the property contentDisplay
     * @test
     * @covers ::getContentDisplay
     * @covers ::setContentDisplay
     */
    public function testProperyContentDisplay()
    {
        $value = new \Urbania\AppleNews\Format\CollectionDisplay();
        $object = new Header();
        $object->setContentDisplay($value);

        $this->assertEquals($value, $object->getContentDisplay());
    }

    /**
     * Test the property role
     * @test
     * @covers ::getRole
     */
    public function testProperyRole()
    {
        $value = "header";
        $object = new Header();

        $this->assertEquals($value, $object->getRole());
    }
}
