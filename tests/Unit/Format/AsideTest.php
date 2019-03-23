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
     * Test the property additions
     * @test
     * @covers ::getAdditions
     * @covers ::setAdditions
     */
    public function testProperyAdditions()
    {
        $value = [];
        $object = new Aside();
        $object->setAdditions($value);

        $this->assertEquals($value, $object->getAdditions());
    }

    /**
     * Test the property components
     * @test
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testProperyComponents()
    {
        $value = [];
        $object = new Aside();
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
        $object = new Aside();
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
        $value = "aside";
        $object = new Aside();

        $this->assertEquals($value, $object->getRole());
    }
}
