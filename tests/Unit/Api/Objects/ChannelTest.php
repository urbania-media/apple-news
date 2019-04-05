<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Channel;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Channel
 */
class ChannelTest extends TestCase
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
        $object = new Channel();
        $object->setCreatedAt($value);

        $this->assertEquals($value, $object->getCreatedAt());
    }

    /**
     * Data provider for property createdAt
     */
    public function createdAtProvider()
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
        $object = new Channel();
        $object->setId($value);

        $this->assertEquals($value, $object->getId());
    }

    /**
     * Data provider for property id
     */
    public function idProvider()
    {
        return [["81eb022c-57b8-11e9-a638-f45c899bcb9d"]];
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
        $object = new Channel();
        $object->setModifiedAt($value);

        $this->assertEquals($value, $object->getModifiedAt());
    }

    /**
     * Data provider for property modifiedAt
     */
    public function modifiedAtProvider()
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
        $object = new Channel();
        $object->setName($value);

        $this->assertEquals($value, $object->getName());
    }

    /**
     * Data provider for property name
     */
    public function nameProvider()
    {
        return [["a string"]];
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
        $object = new Channel();
        $object->setShareUrl($value);

        $this->assertEquals($value, $object->getShareUrl());
    }

    /**
     * Data provider for property shareUrl
     */
    public function shareUrlProvider()
    {
        return [["a string"]];
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
        $object = new Channel();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property website
     * @test
     * @dataProvider websiteProvider
     * @covers ::getWebsite
     * @covers ::setWebsite
     */
    public function testPropertyWebsite($value)
    {
        $object = new Channel();
        $object->setWebsite($value);

        $this->assertEquals($value, $object->getWebsite());
    }

    /**
     * Data provider for property website
     */
    public function websiteProvider()
    {
        return [["a string"]];
    }
}
