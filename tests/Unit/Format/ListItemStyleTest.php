<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ListItemStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ListItemStyle
 */
class ListItemStyleTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new ListItemStyle();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [
            ["bullet"],
            ["decimal"],
            ["lower_roman"],
            ["upper_roman"],
            ["lower_alphabetical"],
            ["upper_alphabetical"],
            ["character"],
            ["none"]
        ];
    }

    /**
     * Test the property character
     * @test
     * @dataProvider characterProvider
     * @covers ::getCharacter
     * @covers ::setCharacter
     */
    public function testPropertyCharacter($value)
    {
        $object = new ListItemStyle();
        $object->setCharacter($value);

        $this->assertEquals($value, $object->getCharacter());
    }

    /**
     * Data provider for property character
     */
    public function characterProvider()
    {
        return [["a string"]];
    }
}
