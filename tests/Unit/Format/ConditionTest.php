<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Condition;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Condition
 */
class ConditionTest extends TestCase
{
    /**
     * Test the property app
     * @test
     * @dataProvider appProvider
     * @covers ::getApp
     * @covers ::setApp
     */
    public function testPropertyApp($value)
    {
        $object = new Condition();
        $object->setApp($value);

        $this->assertEquals($value, $object->getApp());
    }

    /**
     * Data provider for property app
     */
    public static function appProvider()
    {
        return [['any'], ['news'], ['stocks']];
    }

    /**
     * Test the property horizontalSizeClass
     * @test
     * @dataProvider horizontalSizeClassProvider
     * @covers ::getHorizontalSizeClass
     * @covers ::setHorizontalSizeClass
     */
    public function testPropertyHorizontalSizeClass($value)
    {
        $object = new Condition();
        $object->setHorizontalSizeClass($value);

        $this->assertEquals($value, $object->getHorizontalSizeClass());
    }

    /**
     * Data provider for property horizontalSizeClass
     */
    public static function horizontalSizeClassProvider()
    {
        return [['any'], ['regular'], ['compact']];
    }

    /**
     * Test the property maxColumns
     * @test
     * @dataProvider maxColumnsProvider
     * @covers ::getMaxColumns
     * @covers ::setMaxColumns
     */
    public function testPropertyMaxColumns($value)
    {
        $object = new Condition();
        $object->setMaxColumns($value);

        $this->assertEquals($value, $object->getMaxColumns());
    }

    /**
     * Data provider for property maxColumns
     */
    public static function maxColumnsProvider()
    {
        return [[1]];
    }

    /**
     * Test the property maxContentSizeCategory
     * @test
     * @dataProvider maxContentSizeCategoryProvider
     * @covers ::getMaxContentSizeCategory
     * @covers ::setMaxContentSizeCategory
     */
    public function testPropertyMaxContentSizeCategory($value)
    {
        $object = new Condition();
        $object->setMaxContentSizeCategory($value);

        $this->assertEquals($value, $object->getMaxContentSizeCategory());
    }

    /**
     * Data provider for property maxContentSizeCategory
     */
    public static function maxContentSizeCategoryProvider()
    {
        return [
            ['XS'],
            ['S'],
            ['M'],
            ['L'],
            ['XL'],
            ['XXL'],
            ['XXXL'],
            ['AX-M'],
            ['AX-L'],
            ['AX-XL'],
            ['AX-XXL'],
            ['AX-XXXL'],
        ];
    }

    /**
     * Test the property maxSpecVersion
     * @test
     * @dataProvider maxSpecVersionProvider
     * @covers ::getMaxSpecVersion
     * @covers ::setMaxSpecVersion
     */
    public function testPropertyMaxSpecVersion($value)
    {
        $object = new Condition();
        $object->setMaxSpecVersion($value);

        $this->assertEquals($value, $object->getMaxSpecVersion());
    }

    /**
     * Data provider for property maxSpecVersion
     */
    public static function maxSpecVersionProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property maxViewportAspectRatio
     * @test
     * @dataProvider maxViewportAspectRatioProvider
     * @covers ::getMaxViewportAspectRatio
     * @covers ::setMaxViewportAspectRatio
     */
    public function testPropertyMaxViewportAspectRatio($value)
    {
        $object = new Condition();
        $object->setMaxViewportAspectRatio($value);

        $this->assertEquals($value, $object->getMaxViewportAspectRatio());
    }

    /**
     * Data provider for property maxViewportAspectRatio
     */
    public static function maxViewportAspectRatioProvider()
    {
        return [[1.1]];
    }

    /**
     * Test the property maxViewportWidth
     * @test
     * @dataProvider maxViewportWidthProvider
     * @covers ::getMaxViewportWidth
     * @covers ::setMaxViewportWidth
     */
    public function testPropertyMaxViewportWidth($value)
    {
        $object = new Condition();
        $object->setMaxViewportWidth($value);

        $this->assertEquals($value, $object->getMaxViewportWidth());
    }

    /**
     * Data provider for property maxViewportWidth
     */
    public static function maxViewportWidthProvider()
    {
        return [[1]];
    }

    /**
     * Test the property minColumns
     * @test
     * @dataProvider minColumnsProvider
     * @covers ::getMinColumns
     * @covers ::setMinColumns
     */
    public function testPropertyMinColumns($value)
    {
        $object = new Condition();
        $object->setMinColumns($value);

        $this->assertEquals($value, $object->getMinColumns());
    }

    /**
     * Data provider for property minColumns
     */
    public static function minColumnsProvider()
    {
        return [[1]];
    }

    /**
     * Test the property minContentSizeCategory
     * @test
     * @dataProvider minContentSizeCategoryProvider
     * @covers ::getMinContentSizeCategory
     * @covers ::setMinContentSizeCategory
     */
    public function testPropertyMinContentSizeCategory($value)
    {
        $object = new Condition();
        $object->setMinContentSizeCategory($value);

        $this->assertEquals($value, $object->getMinContentSizeCategory());
    }

    /**
     * Data provider for property minContentSizeCategory
     */
    public static function minContentSizeCategoryProvider()
    {
        return [
            ['XS'],
            ['S'],
            ['M'],
            ['L'],
            ['XL'],
            ['XXL'],
            ['XXXL'],
            ['AX-M'],
            ['AX-L'],
            ['AX-XL'],
            ['AX-XXL'],
            ['AX-XXXL'],
        ];
    }

    /**
     * Test the property minSpecVersion
     * @test
     * @dataProvider minSpecVersionProvider
     * @covers ::getMinSpecVersion
     * @covers ::setMinSpecVersion
     */
    public function testPropertyMinSpecVersion($value)
    {
        $object = new Condition();
        $object->setMinSpecVersion($value);

        $this->assertEquals($value, $object->getMinSpecVersion());
    }

    /**
     * Data provider for property minSpecVersion
     */
    public static function minSpecVersionProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property minViewportAspectRatio
     * @test
     * @dataProvider minViewportAspectRatioProvider
     * @covers ::getMinViewportAspectRatio
     * @covers ::setMinViewportAspectRatio
     */
    public function testPropertyMinViewportAspectRatio($value)
    {
        $object = new Condition();
        $object->setMinViewportAspectRatio($value);

        $this->assertEquals($value, $object->getMinViewportAspectRatio());
    }

    /**
     * Data provider for property minViewportAspectRatio
     */
    public static function minViewportAspectRatioProvider()
    {
        return [[1.1]];
    }

    /**
     * Test the property minViewportWidth
     * @test
     * @dataProvider minViewportWidthProvider
     * @covers ::getMinViewportWidth
     * @covers ::setMinViewportWidth
     */
    public function testPropertyMinViewportWidth($value)
    {
        $object = new Condition();
        $object->setMinViewportWidth($value);

        $this->assertEquals($value, $object->getMinViewportWidth());
    }

    /**
     * Data provider for property minViewportWidth
     */
    public static function minViewportWidthProvider()
    {
        return [[1]];
    }

    /**
     * Test the property platform
     * @test
     * @dataProvider platformProvider
     * @covers ::getPlatform
     * @covers ::setPlatform
     */
    public function testPropertyPlatform($value)
    {
        $object = new Condition();
        $object->setPlatform($value);

        $this->assertEquals($value, $object->getPlatform());
    }

    /**
     * Data provider for property platform
     */
    public static function platformProvider()
    {
        return [['any'], ['ios'], ['macos'], ['web']];
    }

    /**
     * Test the property preferredColorScheme
     * @test
     * @dataProvider preferredColorSchemeProvider
     * @covers ::getPreferredColorScheme
     * @covers ::setPreferredColorScheme
     */
    public function testPropertyPreferredColorScheme($value)
    {
        $object = new Condition();
        $object->setPreferredColorScheme($value);

        $this->assertEquals($value, $object->getPreferredColorScheme());
    }

    /**
     * Data provider for property preferredColorScheme
     */
    public static function preferredColorSchemeProvider()
    {
        return [['any'], ['light'], ['dark']];
    }

    /**
     * Test the property subscriptionStatus
     * @test
     * @dataProvider subscriptionStatusProvider
     * @covers ::getSubscriptionStatus
     * @covers ::setSubscriptionStatus
     */
    public function testPropertySubscriptionStatus($value)
    {
        $object = new Condition();
        $object->setSubscriptionStatus($value);

        $this->assertEquals($value, $object->getSubscriptionStatus());
    }

    /**
     * Data provider for property subscriptionStatus
     */
    public static function subscriptionStatusProvider()
    {
        return [['bundle'], ['subscribed']];
    }

    /**
     * Test the property verticalSizeClass
     * @test
     * @dataProvider verticalSizeClassProvider
     * @covers ::getVerticalSizeClass
     * @covers ::setVerticalSizeClass
     */
    public function testPropertyVerticalSizeClass($value)
    {
        $object = new Condition();
        $object->setVerticalSizeClass($value);

        $this->assertEquals($value, $object->getVerticalSizeClass());
    }

    /**
     * Data provider for property verticalSizeClass
     */
    public static function verticalSizeClassProvider()
    {
        return [['any'], ['regular'], ['compact']];
    }

    /**
     * Test the property territory
     * @test
     * @dataProvider territoryProvider
     * @covers ::getTerritory
     * @covers ::setTerritory
     */
    public function testPropertyTerritory($value)
    {
        $object = new Condition();
        $object->setTerritory($value);

        $this->assertEquals($value, $object->getTerritory());
    }

    /**
     * Data provider for property territory
     */
    public static function territoryProvider()
    {
        return [['US'], ['AU'], ['GB'], ['CA']];
    }

    /**
     * Test the property viewLocation
     * @test
     * @dataProvider viewLocationProvider
     * @covers ::getViewLocation
     * @covers ::setViewLocation
     */
    public function testPropertyViewLocation($value)
    {
        $object = new Condition();
        $object->setViewLocation($value);

        $this->assertEquals($value, $object->getViewLocation());
    }

    /**
     * Data provider for property viewLocation
     */
    public static function viewLocationProvider()
    {
        return [['any'], ['article'], ['issue_table_of_contents'], ['issue']];
    }
}
