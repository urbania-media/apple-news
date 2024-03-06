<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalAutoPlacement;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalAutoPlacement
 */
class ConditionalAutoPlacementTest extends TestCase
{
    /**
     * Test the property conditions
     * @test
     * @dataProvider conditionsProvider
     * @covers ::getConditions
     * @covers ::setConditions
     */
    public function testPropertyConditions($value)
    {
        $object = new ConditionalAutoPlacement();
        $object->setConditions($value);

        $this->assertEquals($value, $object->getConditions());
    }

    /**
     * Data provider for property conditions
     */
    public static function conditionsProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\Condition()],
            [[new \Urbania\AppleNews\Format\Condition()]],
        ];
    }

    /**
     * Test the property enabled
     * @test
     * @dataProvider enabledProvider
     * @covers ::getEnabled
     * @covers ::setEnabled
     */
    public function testPropertyEnabled($value)
    {
        $object = new ConditionalAutoPlacement();
        $object->setEnabled($value);

        $this->assertEquals($value, $object->getEnabled());
    }

    /**
     * Data provider for property enabled
     */
    public static function enabledProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property layout
     * @test
     * @dataProvider layoutProvider
     * @covers ::getLayout
     * @covers ::setLayout
     */
    public function testPropertyLayout($value)
    {
        $object = new ConditionalAutoPlacement();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [[new \Urbania\AppleNews\Format\AutoPlacementLayout()]];
    }
}
