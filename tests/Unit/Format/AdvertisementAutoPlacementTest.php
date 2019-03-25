<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\AdvertisementAutoPlacement;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\AdvertisementAutoPlacement
 */
class AdvertisementAutoPlacementTest extends TestCase
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
        $object = new AdvertisementAutoPlacement();
        $object->setBannerType($value);

        $this->assertEquals($value, $object->getBannerType());
    }

    /**
     * Data provider for property bannerType
     */
    public function bannerTypeProvider()
    {
        return [["any"], ["standard"], ["double_height"], ["large"]];
    }

    /**
     * Test the property conditional
     * @test
     * @dataProvider conditionalProvider
     * @covers ::getConditional
     * @covers ::setConditional
     */
    public function testPropertyConditional($value)
    {
        $object = new AdvertisementAutoPlacement();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public function conditionalProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ConditionalAutoPlacement()]]];
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
        $object = new AdvertisementAutoPlacement();
        $object->setDistanceFromMedia($value);

        $this->assertEquals($value, $object->getDistanceFromMedia());
    }

    /**
     * Data provider for property distanceFromMedia
     */
    public function distanceFromMediaProvider()
    {
        return [["1vh"], [1], ["1vmin"]];
    }

    /**
     * Test the property enabled
     * @test
     * @dataProvider enabledProvider
     * @covers ::getEnabled
     * @covers ::setEnabled
     */
    public function testPropertyEnabled($value)
    {
        $object = new AdvertisementAutoPlacement();
        $object->setEnabled($value);

        $this->assertEquals($value, $object->getEnabled());
    }

    /**
     * Data provider for property enabled
     */
    public function enabledProvider()
    {
        return [[true], [false]];
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
        $object = new AdvertisementAutoPlacement();
        $object->setFrequency($value);

        $this->assertEquals($value, $object->getFrequency());
    }

    /**
     * Data provider for property frequency
     */
    public function frequencyProvider()
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
        $object = new AdvertisementAutoPlacement();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public function layoutProvider()
    {
        return [[new \Urbania\AppleNews\Format\AutoPlacementLayout()]];
    }
}
