<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\AutoPlacement;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\AutoPlacement
 */
class AutoPlacementTest extends TestCase
{
    /**
     * Test the property advertisement
     * @test
     * @dataProvider advertisementProvider
     * @covers ::getAdvertisement
     * @covers ::setAdvertisement
     */
    public function testPropertyAdvertisement($value)
    {
        $object = new AutoPlacement();
        $object->setAdvertisement($value);

        $this->assertEquals($value, $object->getAdvertisement());
    }

    /**
     * Data provider for property advertisement
     */
    public static function advertisementProvider()
    {
        return [[new \Urbania\AppleNews\Format\AdvertisementAutoPlacement()]];
    }
}
