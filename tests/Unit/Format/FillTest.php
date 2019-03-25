<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Fill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Fill
 */
class FillTest extends TestCase
{
    /**
     * Test the property attachment
     * @test
     * @dataProvider attachmentProvider
     * @covers ::getAttachment
     * @covers ::setAttachment
     */
    public function testPropertyAttachment($value)
    {
        $object = new Fill();
        $object->setAttachment($value);

        $this->assertEquals($value, $object->getAttachment());
    }

    /**
     * Data provider for property attachment
     */
    public function attachmentProvider()
    {
        return [["fixed"], ["scroll"]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new Fill();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["a string"]];
    }
}
