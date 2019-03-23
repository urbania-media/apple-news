<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Illustrator;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Illustrator
 */
class IllustratorTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @covers ::getRole
     */
    public function testProperyRole()
    {
        $value = "illustrator";
        $object = new Illustrator();

        $this->assertEquals($value, $object->getRole());
    }
}
