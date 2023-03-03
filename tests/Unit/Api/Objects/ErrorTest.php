<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Error;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Error
 */
class ErrorTest extends TestCase
{
    /**
     * Test the property code
     * @test
     * @dataProvider codeProvider
     * @covers ::getCode
     * @covers ::setCode
     */
    public function testPropertyCode($value)
    {
        $object = new Error();
        $object->setCode($value);

        $this->assertEquals($value, $object->getCode());
    }

    /**
     * Data provider for property code
     */
    public static function codeProvider()
    {
        return [["a code"]];
    }

    /**
     * Test the property keyPath
     * @test
     * @dataProvider keyPathProvider
     * @covers ::getKeyPath
     * @covers ::setKeyPath
     */
    public function testPropertyKeyPath($value)
    {
        $object = new Error();
        $object->setKeyPath($value);

        $this->assertEquals($value, $object->getKeyPath());
    }

    /**
     * Data provider for property keyPath
     */
    public static function keyPathProvider()
    {
        return [[[]]];
    }

    /**
     * Test the property message
     * @test
     * @dataProvider messageProvider
     * @covers ::getMessage
     * @covers ::setMessage
     */
    public function testPropertyMessage($value)
    {
        $object = new Error();
        $object->setMessage($value);

        $this->assertEquals($value, $object->getMessage());
    }

    /**
     * Data provider for property message
     */
    public static function messageProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property status
     * @test
     * @dataProvider statusProvider
     * @covers ::getStatus
     * @covers ::setStatus
     */
    public function testPropertyStatus($value)
    {
        $object = new Error();
        $object->setStatus($value);

        $this->assertEquals($value, $object->getStatus());
    }

    /**
     * Data provider for property status
     */
    public static function statusProvider()
    {
        return [[200], [400]];
    }

    /**
     * Test the property value
     * @test
     * @dataProvider valueProvider
     * @covers ::getValue
     * @covers ::setValue
     */
    public function testPropertyValue($value)
    {
        $object = new Error();
        $object->setValue($value);

        $this->assertEquals($value, $object->getValue());
    }

    /**
     * Data provider for property value
     */
    public static function valueProvider()
    {
        return [["a string"]];
    }
}
