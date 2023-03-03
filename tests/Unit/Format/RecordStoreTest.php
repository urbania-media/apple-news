<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\RecordStore;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\RecordStore
 */
class RecordStoreTest extends TestCase
{
    /**
     * Test the property descriptors
     * @test
     * @dataProvider descriptorsProvider
     * @covers ::getDescriptors
     * @covers ::setDescriptors
     */
    public function testPropertyDescriptors($value)
    {
        $object = new RecordStore();
        $object->setDescriptors($value);

        $this->assertEquals($value, $object->getDescriptors());
    }

    /**
     * Data provider for property descriptors
     */
    public static function descriptorsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\DataDescriptor()]]];
    }

    /**
     * Test the property records
     * @test
     * @dataProvider recordsProvider
     * @covers ::getRecords
     * @covers ::setRecords
     */
    public function testPropertyRecords($value)
    {
        $object = new RecordStore();
        $object->setRecords($value);

        $this->assertEquals($value, $object->getRecords());
    }

    /**
     * Data provider for property records
     */
    public static function recordsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Records()]]];
    }
}
