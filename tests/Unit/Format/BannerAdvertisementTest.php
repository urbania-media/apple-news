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
     * @covers ::getBannerType
     * @covers ::setBannerType
     */
    public function testProperyBannerType()
    {
        $value = "standard";
        $object = new BannerAdvertisement();
        $object->setBannerType($value);

        $this->assertEquals($value, $object->getBannerType());
    }

    /**
     * Test the property role
     * @test
     * @covers ::getRole
     */
    public function testProperyRole()
    {
        $value = "banner_advertisement";
        $object = new BannerAdvertisement();

        $this->assertEquals($value, $object->getRole());
    }
}
