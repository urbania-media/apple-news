<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Throttling;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Throttling
 */
class ThrottlingTest extends TestCase
{
    /**
     * Test the property estimatedDelayInSeconds
     * @test
     * @dataProvider estimatedDelayInSecondsProvider
     * @covers ::getEstimatedDelayInSeconds
     * @covers ::setEstimatedDelayInSeconds
     */
    public function testPropertyEstimatedDelayInSeconds($value)
    {
        $object = new Throttling();
        $object->setEstimatedDelayInSeconds($value);

        $this->assertEquals($value, $object->getEstimatedDelayInSeconds());
    }

    /**
     * Data provider for property estimatedDelayInSeconds
     */
    public function estimatedDelayInSecondsProvider()
    {
        return [[1]];
    }

    /**
     * Test the property isThrottled
     * @test
     * @dataProvider isThrottledProvider
     * @covers ::getIsThrottled
     * @covers ::setIsThrottled
     */
    public function testPropertyIsThrottled($value)
    {
        $object = new Throttling();
        $object->setIsThrottled($value);

        $this->assertEquals($value, $object->getIsThrottled());
    }

    /**
     * Data provider for property isThrottled
     */
    public function isThrottledProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property queueSize
     * @test
     * @dataProvider queueSizeProvider
     * @covers ::getQueueSize
     * @covers ::setQueueSize
     */
    public function testPropertyQueueSize($value)
    {
        $object = new Throttling();
        $object->setQueueSize($value);

        $this->assertEquals($value, $object->getQueueSize());
    }

    /**
     * Data provider for property queueSize
     */
    public function queueSizeProvider()
    {
        return [[1]];
    }

    /**
     * Test the property quotaAvailable
     * @test
     * @dataProvider quotaAvailableProvider
     * @covers ::getQuotaAvailable
     * @covers ::setQuotaAvailable
     */
    public function testPropertyQuotaAvailable($value)
    {
        $object = new Throttling();
        $object->setQuotaAvailable($value);

        $this->assertEquals($value, $object->getQuotaAvailable());
    }

    /**
     * Data provider for property quotaAvailable
     */
    public function quotaAvailableProvider()
    {
        return [[1]];
    }
}
