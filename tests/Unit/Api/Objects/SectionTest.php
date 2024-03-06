<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Section;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Section
 */
class SectionTest extends TestCase
{
    /**
     * Test the property createdAt
     * @test
     * @dataProvider createdAtProvider
     * @covers ::getCreatedAt
     * @covers ::setCreatedAt
     */
    public function testPropertyCreatedAt($value)
    {
        $object = new Section();
        $object->setCreatedAt($value);

        $this->assertEquals($value, $object->getCreatedAt());
    }

    /**
     * Data provider for property createdAt
     */
    public static function createdAtProvider()
    {
        return [[null]];
    }

    /**
     * Test the property id
     * @test
     * @dataProvider idProvider
     * @covers ::getId
     * @covers ::setId
     */
    public function testPropertyId($value)
    {
        $object = new Section();
        $object->setId($value);

        $this->assertEquals($value, $object->getId());
    }

    /**
     * Data provider for property id
     */
    public static function idProvider()
    {
        return [['5a07f304-dbd5-11ee-9d8e-ca53fbc83398']];
    }

    /**
     * Test the property isDefault
     * @test
     * @dataProvider isDefaultProvider
     * @covers ::getIsDefault
     * @covers ::setIsDefault
     */
    public function testPropertyIsDefault($value)
    {
        $object = new Section();
        $object->setIsDefault($value);

        $this->assertEquals($value, $object->getIsDefault());
    }

    /**
     * Data provider for property isDefault
     */
    public static function isDefaultProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property modifiedAt
     * @test
     * @dataProvider modifiedAtProvider
     * @covers ::getModifiedAt
     * @covers ::setModifiedAt
     */
    public function testPropertyModifiedAt($value)
    {
        $object = new Section();
        $object->setModifiedAt($value);

        $this->assertEquals($value, $object->getModifiedAt());
    }

    /**
     * Data provider for property modifiedAt
     */
    public static function modifiedAtProvider()
    {
        return [[null]];
    }

    /**
     * Test the property name
     * @test
     * @dataProvider nameProvider
     * @covers ::getName
     * @covers ::setName
     */
    public function testPropertyName($value)
    {
        $object = new Section();
        $object->setName($value);

        $this->assertEquals($value, $object->getName());
    }

    /**
     * Data provider for property name
     */
    public static function nameProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property shareUrl
     * @test
     * @dataProvider shareUrlProvider
     * @covers ::getShareUrl
     * @covers ::setShareUrl
     */
    public function testPropertyShareUrl($value)
    {
        $object = new Section();
        $object->setShareUrl($value);

        $this->assertEquals($value, $object->getShareUrl());
    }

    /**
     * Data provider for property shareUrl
     */
    public static function shareUrlProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new Section();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['a string']];
    }
}
