<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\CampaignData;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\CampaignData
 */
class CampaignDataTest extends TestCase
{
    /**
     * Test the property data
     * @test
     * @dataProvider dataProvider
     * @covers ::getData
     * @covers ::setData
     */
    public function testPropertyData($value)
    {
        $object = new CampaignData();
        $object->setData($value);

        $this->assertEquals($value, $object->getData());
    }

    /**
     * Data provider for property data
     */
    public function dataProvider()
    {
        return [[["test" => "value"]]];
    }
}
