<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\PromoteArticleRequest;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\PromoteArticleRequest
 */
class PromoteArticleRequestTest extends TestCase
{
    /**
     * Test the property articleIds
     * @test
     * @dataProvider articleIdsProvider
     * @covers ::getArticleIds
     * @covers ::setArticleIds
     */
    public function testPropertyArticleIds($value)
    {
        $object = new PromoteArticleRequest();
        $object->setArticleIds($value);

        $this->assertEquals($value, $object->getArticleIds());
    }

    /**
     * Data provider for property articleIds
     */
    public function articleIdsProvider()
    {
        return [[[]]];
    }
}
