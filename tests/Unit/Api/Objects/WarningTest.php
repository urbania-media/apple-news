<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Warning;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Warning
 */
class WarningTest extends TestCase
{
    /**
     * Test the property keyPath
     * @test
     * @dataProvider keyPathProvider
     * @covers ::getKeyPath
     * @covers ::setKeyPath
     */
    public function testPropertyKeyPath($value)
    {
        $object = new Warning();
        $object->setKeyPath($value);

        $this->assertEquals($value, $object->getKeyPath());
    }

    /**
     * Data provider for property keyPath
     */
    public function keyPathProvider()
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
        $object = new Warning();
        $object->setMessage($value);

        $this->assertEquals($value, $object->getMessage());
    }

    /**
     * Data provider for property message
     */
    public function messageProvider()
    {
        return [["a string"]];
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
        $object = new Warning();
        $object->setValue($value);

        $this->assertEquals($value, $object->getValue());
    }

    /**
     * Data provider for property value
     */
    public function valueProvider()
    {
        return [["a string"]];
    }
}
