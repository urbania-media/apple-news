<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\LinkedArticle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\LinkedArticle
 */
class LinkedArticleTest extends TestCase
{
    /**
     * Test the property relationship
     * @test
     * @dataProvider relationshipProvider
     * @covers ::getRelationship
     * @covers ::setRelationship
     */
    public function testPropertyRelationship($value)
    {
        $object = new LinkedArticle();
        $object->setRelationship($value);

        $this->assertEquals($value, $object->getRelationship());
    }

    /**
     * Data provider for property relationship
     */
    public static function relationshipProvider()
    {
        return [['related'], ['promoted']];
    }

    /**
     * Test the property URL
     * @test
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new LinkedArticle();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public static function URLProvider()
    {
        return [['http://example.com'], ['https://example.com']];
    }
}
