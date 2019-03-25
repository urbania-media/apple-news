<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Author;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Author
 */
class AuthorTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Author();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["author"]];
    }
}
