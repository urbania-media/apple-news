<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\ArticleLinksRequest;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\ArticleLinksRequest
 */
class ArticleLinksRequestTest extends TestCase
{
    /**
     * Test the property sections
     * @test
     * @dataProvider sectionsProvider
     * @covers ::getSections
     * @covers ::setSections
     */
    public function testPropertySections($value)
    {
        $object = new ArticleLinksRequest();
        $object->setSections($value);

        $this->assertEquals($value, $object->getSections());
    }

    /**
     * Data provider for property sections
     */
    public static function sectionsProvider()
    {
        return [[[]]];
    }
}
