<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Section;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Section
 */
class SectionTest extends TestCase
{
    /**
     * Test the property additions
     * @test
     * @dataProvider additionsProvider
     * @covers ::getAdditions
     * @covers ::setAdditions
     */
    public function testPropertyAdditions($value)
    {
        $object = new Section();
        $object->setAdditions($value);

        $this->assertEquals($value, $object->getAdditions());
    }

    /**
     * Data provider for property additions
     */
    public function additionsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ComponentLink()]]];
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
        $object = new Section();
        $object->setComponents($value);

        $this->assertEquals($value, $object->getComponents());
    }

    /**
     * Data provider for property components
     */
    public function componentsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Component()]]];
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
        $object = new Section();
        $object->setContentDisplay($value);

        $this->assertEquals($value, $object->getContentDisplay());
    }

    /**
     * Data provider for property contentDisplay
     */
    public function contentDisplayProvider()
    {
        return [[new \Urbania\AppleNews\Format\CollectionDisplay()]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Section();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["section"]];
    }

    /**
     * Test the property scene
     * @test
     * @dataProvider sceneProvider
     * @covers ::getScene
     * @covers ::setScene
     */
    public function testPropertyScene($value)
    {
        $object = new Section();
        $object->setScene($value);

        $this->assertEquals($value, $object->getScene());
    }

    /**
     * Data provider for property scene
     */
    public function sceneProvider()
    {
        return [[new \Urbania\AppleNews\Format\Scene()]];
    }
}
