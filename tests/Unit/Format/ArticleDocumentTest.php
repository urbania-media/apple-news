<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ArticleDocument
 */
class ArticleDocumentTest extends TestCase
{
    /**
     * Test the property components
     * @test
     * @dataProvider componentsProvider
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testPropertyComponents($value)
    {
        $object = new ArticleDocument();
        $object->setComponents($value);

        $this->assertEquals($value, $object->getComponents());
    }

    /**
     * Data provider for property components
     */
    public static function componentsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Component()]]];
    }

    /**
     * Test the property componentTextStyles
     * @test
     * @dataProvider componentTextStylesProvider
     * @covers ::getComponentTextStyles
     * @covers ::setComponentTextStyles
     */
    public function testPropertyComponentTextStyles($value)
    {
        $object = new ArticleDocument();
        $object->setComponentTextStyles($value);

        $this->assertEquals($value, $object->getComponentTextStyles());
    }

    /**
     * Data provider for property componentTextStyles
     */
    public static function componentTextStylesProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentTextStyles()]];
    }

    /**
     * Test the property identifier
     * @test
     * @dataProvider identifierProvider
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testPropertyIdentifier($value)
    {
        $object = new ArticleDocument();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property language
     * @test
     * @dataProvider languageProvider
     * @covers ::getLanguage
     * @covers ::setLanguage
     */
    public function testPropertyLanguage($value)
    {
        $object = new ArticleDocument();
        $object->setLanguage($value);

        $this->assertEquals($value, $object->getLanguage());
    }

    /**
     * Data provider for property language
     */
    public static function languageProvider()
    {
        return [["a string"]];
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
        $object = new ArticleDocument();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [[new \Urbania\AppleNews\Format\Layout()]];
    }

    /**
     * Test the property title
     * @test
     * @dataProvider titleProvider
     * @covers ::getTitle
     * @covers ::setTitle
     */
    public function testPropertyTitle($value)
    {
        $object = new ArticleDocument();
        $object->setTitle($value);

        $this->assertEquals($value, $object->getTitle());
    }

    /**
     * Data provider for property title
     */
    public static function titleProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property version
     * @test
     * @dataProvider versionProvider
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testPropertyVersion($value)
    {
        $object = new ArticleDocument();
        $object->setVersion($value);

        $this->assertEquals($value, $object->getVersion());
    }

    /**
     * Data provider for property version
     */
    public static function versionProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property advertisingSettings
     * @test
     * @dataProvider advertisingSettingsProvider
     * @covers ::getAdvertisingSettings
     * @covers ::setAdvertisingSettings
     */
    public function testPropertyAdvertisingSettings($value)
    {
        $object = new ArticleDocument();
        $object->setAdvertisingSettings($value);

        $this->assertEquals($value, $object->getAdvertisingSettings());
    }

    /**
     * Data provider for property advertisingSettings
     */
    public static function advertisingSettingsProvider()
    {
        return [[new \Urbania\AppleNews\Format\AdvertisingSettings()]];
    }

    /**
     * Test the property autoplacement
     * @test
     * @dataProvider autoplacementProvider
     * @covers ::getAutoplacement
     * @covers ::setAutoplacement
     */
    public function testPropertyAutoplacement($value)
    {
        $object = new ArticleDocument();
        $object->setAutoplacement($value);

        $this->assertEquals($value, $object->getAutoplacement());
    }

    /**
     * Data provider for property autoplacement
     */
    public static function autoplacementProvider()
    {
        return [[new \Urbania\AppleNews\Format\AutoPlacement()]];
    }

    /**
     * Test the property componentLayouts
     * @test
     * @dataProvider componentLayoutsProvider
     * @covers ::getComponentLayouts
     * @covers ::setComponentLayouts
     */
    public function testPropertyComponentLayouts($value)
    {
        $object = new ArticleDocument();
        $object->setComponentLayouts($value);

        $this->assertEquals($value, $object->getComponentLayouts());
    }

    /**
     * Data provider for property componentLayouts
     */
    public static function componentLayoutsProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentLayouts()]];
    }

    /**
     * Test the property componentStyles
     * @test
     * @dataProvider componentStylesProvider
     * @covers ::getComponentStyles
     * @covers ::setComponentStyles
     */
    public function testPropertyComponentStyles($value)
    {
        $object = new ArticleDocument();
        $object->setComponentStyles($value);

        $this->assertEquals($value, $object->getComponentStyles());
    }

    /**
     * Data provider for property componentStyles
     */
    public static function componentStylesProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyles()]];
    }

    /**
     * Test the property documentStyle
     * @test
     * @dataProvider documentStyleProvider
     * @covers ::getDocumentStyle
     * @covers ::setDocumentStyle
     */
    public function testPropertyDocumentStyle($value)
    {
        $object = new ArticleDocument();
        $object->setDocumentStyle($value);

        $this->assertEquals($value, $object->getDocumentStyle());
    }

    /**
     * Data provider for property documentStyle
     */
    public static function documentStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\DocumentStyle()]];
    }

    /**
     * Test the property metadata
     * @test
     * @dataProvider metadataProvider
     * @covers ::getMetadata
     * @covers ::setMetadata
     */
    public function testPropertyMetadata($value)
    {
        $object = new ArticleDocument();
        $object->setMetadata($value);

        $this->assertEquals($value, $object->getMetadata());
    }

    /**
     * Data provider for property metadata
     */
    public static function metadataProvider()
    {
        return [[new \Urbania\AppleNews\Format\Metadata()]];
    }

    /**
     * Test the property subtitle
     * @test
     * @dataProvider subtitleProvider
     * @covers ::getSubtitle
     * @covers ::setSubtitle
     */
    public function testPropertySubtitle($value)
    {
        $object = new ArticleDocument();
        $object->setSubtitle($value);

        $this->assertEquals($value, $object->getSubtitle());
    }

    /**
     * Data provider for property subtitle
     */
    public static function subtitleProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property textStyles
     * @test
     * @dataProvider textStylesProvider
     * @covers ::getTextStyles
     * @covers ::setTextStyles
     */
    public function testPropertyTextStyles($value)
    {
        $object = new ArticleDocument();
        $object->setTextStyles($value);

        $this->assertEquals($value, $object->getTextStyles());
    }

    /**
     * Data provider for property textStyles
     */
    public static function textStylesProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextStyles()]];
    }
}
