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
     * @covers ::getDescriptors
     * @covers ::setDescriptors
     */
    public function testProperyDescriptors()
    {
        $value = [];
        $object = new RecordStore();
        $object->setDescriptors($value);

        $this->assertEquals($value, $object->getDescriptors());
    }

    /**
     * Test the property records
     * @test
     * @covers ::getRecords
     * @covers ::setRecords
     */
    public function testProperyRecords()
    {
        $value = [];
        $object = new RecordStore();
        $object->setRecords($value);

        $this->assertEquals($value, $object->getRecords());
    }
}
