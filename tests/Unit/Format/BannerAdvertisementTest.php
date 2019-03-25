<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\BannerAdvertisement;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\BannerAdvertisement
 */
class BannerAdvertisementTest extends TestCase
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
        $object = new BannerAdvertisement();
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
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new BannerAdvertisement();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["banner_advertisement"]];
    }
}
