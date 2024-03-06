<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\AdvertisingSettings;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\AdvertisingSettings
 */
class AdvertisingSettingsTest extends TestCase
{
    /**
     * Test the property bannerType
     * @test
     * @dataProvider bannerTypeProvider
     * @covers ::getBannerType
     * @covers ::setBannerType
     */
    public function testPropertyBannerType($value)
    {
        $object = new AdvertisingSettings();
        $object->setBannerType($value);

        $this->assertEquals($value, $object->getBannerType());
    }

    /**
     * Data provider for property bannerType
     */
    public static function bannerTypeProvider()
    {
        return [['any'], ['standard'], ['double_height'], ['large']];
    }

    /**
     * Test the property distanceFromMedia
     * @test
     * @dataProvider distanceFromMediaProvider
     * @covers ::getDistanceFromMedia
     * @covers ::setDistanceFromMedia
     */
    public function testPropertyDistanceFromMedia($value)
    {
        $object = new AdvertisingSettings();
        $object->setDistanceFromMedia($value);

        $this->assertEquals($value, $object->getDistanceFromMedia());
    }

    /**
     * Data provider for property distanceFromMedia
     */
    public static function distanceFromMediaProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1]];
    }

    /**
     * Test the property frequency
     * @test
     * @dataProvider frequencyProvider
     * @covers ::getFrequency
     * @covers ::setFrequency
     */
    public function testPropertyFrequency($value)
    {
        $object = new AdvertisingSettings();
        $object->setFrequency($value);

        $this->assertEquals($value, $object->getFrequency());
    }

    /**
     * Data provider for property frequency
     */
    public static function frequencyProvider()
    {
        return [[1]];
    }

    /**
     * Test the property layout
     * @test
     * @dataProvider layoutProvider
     * @covers ::getLayout
     * @covers ::setLayout
     */
    public function testPropertyLayout($value)
    {
        $object = new AdvertisingSettings();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [[new \Urbania\AppleNews\Format\AdvertisingLayout()]];
    }
}
