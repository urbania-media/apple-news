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
     * @dataProvider componentsProvider
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testPropertyComponents($value)
    {
        $object = new Header();
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
        $object = new Header();
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
        $object = new Header();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["header"]];
    }
}
