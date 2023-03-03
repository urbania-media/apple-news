<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\SectionResponse;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\SectionResponse
 */
class SectionResponseTest extends TestCase
{
    /**
     * Test the property links
     * @test
     * @dataProvider linksProvider
     * @covers ::getLinks
     * @covers ::setLinks
     */
    public function testPropertyLinks($value)
    {
        $object = new SectionResponse();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public static function linksProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\SectionLinks()]];
    }
}
