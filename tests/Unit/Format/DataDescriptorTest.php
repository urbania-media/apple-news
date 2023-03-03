<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\DataDescriptor;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\DataDescriptor
 */
class DataDescriptorTest extends TestCase
{
    /**
     * Test the property dataType
     * @test
     * @dataProvider dataTypeProvider
     * @covers ::getDataType
     * @covers ::setDataType
     */
    public function testPropertyDataType($value)
    {
        $object = new DataDescriptor();
        $object->setDataType($value);

        $this->assertEquals($value, $object->getDataType());
    }

    /**
     * Data provider for property dataType
     */
    public static function dataTypeProvider()
    {
        return [
            ["string"],
            ["text"],
            ["image"],
            ["number"],
            ["integer"],
            ["float"]
        ];
    }

    /**
     * Test the property key
     * @test
     * @dataProvider keyProvider
     * @covers ::getKey
     * @covers ::setKey
     */
    public function testPropertyKey($value)
    {
        $object = new DataDescriptor();
        $object->setKey($value);

        $this->assertEquals($value, $object->getKey());
    }

    /**
     * Data provider for property key
     */
    public static function keyProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property format
     * @test
     * @dataProvider formatProvider
     * @covers ::getFormat
     * @covers ::setFormat
     */
    public function testPropertyFormat($value)
    {
        $object = new DataDescriptor();
        $object->setFormat($value);

        $this->assertEquals($value, $object->getFormat());
    }

    /**
     * Data provider for property format
     */
    public static function formatProvider()
    {
        return [[new \Urbania\AppleNews\Format\DataFormat()]];
    }

    /**
     * Test the property identifier
     * @test
     * @dataProvider identifierProvider
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testPropertyIdentifier($value)
    {
        $object = new DataDescriptor();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property label
     * @test
     * @dataProvider labelProvider
     * @covers ::getLabel
     * @covers ::setLabel
     */
    public function testPropertyLabel($value)
    {
        $object = new DataDescriptor();
        $object->setLabel($value);

        $this->assertEquals($value, $object->getLabel());
    }

    /**
     * Data provider for property label
     */
    public static function labelProvider()
    {
        return [[new \Urbania\AppleNews\Format\FormattedText()], ["a string"]];
    }
}
