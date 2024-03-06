<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalDocumentStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalDocumentStyle
 */
class ConditionalDocumentStyleTest extends TestCase
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
        $object = new ConditionalDocumentStyle();
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
     * Test the property backgroundColor
     * @test
     * @dataProvider backgroundColorProvider
     * @covers ::getBackgroundColor
     * @covers ::setBackgroundColor
     */
    public function testPropertyBackgroundColor($value)
    {
        $object = new ConditionalDocumentStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Data provider for property backgroundColor
     */
    public static function backgroundColorProvider()
    {
        return [['#fff'], ['#000']];
    }
}
