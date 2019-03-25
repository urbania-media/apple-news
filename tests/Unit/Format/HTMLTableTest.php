<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\HTMLTable;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\HTMLTable
 */
class HTMLTableTest extends TestCase
{
    /**
     * Test the property html
     * @test
     * @dataProvider htmlProvider
     * @covers ::getHtml
     * @covers ::setHtml
     */
    public function testPropertyHtml($value)
    {
        $object = new HTMLTable();
        $object->setHtml($value);

        $this->assertEquals($value, $object->getHtml());
    }

    /**
     * Data provider for property html
     */
    public function htmlProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new HTMLTable();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["htmltable"]];
    }
}
