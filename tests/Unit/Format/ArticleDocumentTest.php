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
     * Test the property version
     * @test
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testProperyVersion()
    {
        $value = "a string";
        $object = new ArticleDocument();
        $object->setVersion($value);

        $this->assertEquals($value, $object->getVersion());
    }

    /**
     * Test the property identifier
     * @test
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testProperyIdentifier()
    {
        $value = "a string";
        $object = new ArticleDocument();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Test the property title
     * @test
     * @covers ::getTitle
     * @covers ::setTitle
     */
    public function testProperyTitle()
    {
        $value = "a string";
        $object = new ArticleDocument();
        $object->setTitle($value);

        $this->assertEquals($value, $object->getTitle());
    }

    /**
     * Test the property language
     * @test
     * @covers ::getLanguage
     * @covers ::setLanguage
     */
    public function testProperyLanguage()
    {
        $value = "a string";
        $object = new ArticleDocument();
        $object->setLanguage($value);

        $this->assertEquals($value, $object->getLanguage());
    }

    /**
     * Test the property layout
     * @test
     * @covers ::getLayout
     * @covers ::setLayout
     */
    public function testProperyLayout()
    {
        $value = new \Urbania\AppleNews\Format\Layout();
        $object = new ArticleDocument();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Test the property components
     * @test
     * @covers ::getComponents
     * @covers ::setComponents
     */
    public function testProperyComponents()
    {
        $value = [];
        $object = new ArticleDocument();
        $object->setComponents($value);

        $this->assertEquals($value, $object->getComponents());
    }

    /**
     * Test the property componentTextStyles
     * @test
     * @covers ::getComponentTextStyles
     * @covers ::setComponentTextStyles
     */
    public function testProperyComponentTextStyles()
    {
        $value = new \Urbania\AppleNews\Format\ComponentTextStyles();
        $object = new ArticleDocument();
        $object->setComponentTextStyles($value);

        $this->assertEquals($value, $object->getComponentTextStyles());
    }

    /**
     * Test the property advertisingSettings
     * @test
     * @covers ::getAdvertisingSettings
     * @covers ::setAdvertisingSettings
     */
    public function testProperyAdvertisingSettings()
    {
        $value = new \Urbania\AppleNews\Format\AdvertisingSettings();
        $object = new ArticleDocument();
        $object->setAdvertisingSettings($value);

        $this->assertEquals($value, $object->getAdvertisingSettings());
    }

    /**
     * Test the property subtitle
     * @test
     * @covers ::getSubtitle
     * @covers ::setSubtitle
     */
    public function testProperySubtitle()
    {
        $value = "a string";
        $object = new ArticleDocument();
        $object->setSubtitle($value);

        $this->assertEquals($value, $object->getSubtitle());
    }

    /**
     * Test the property metadata
     * @test
     * @covers ::getMetadata
     * @covers ::setMetadata
     */
    public function testProperyMetadata()
    {
        $value = new \Urbania\AppleNews\Format\Metadata();
        $object = new ArticleDocument();
        $object->setMetadata($value);

        $this->assertEquals($value, $object->getMetadata());
    }

    /**
     * Test the property documentStyle
     * @test
     * @covers ::getDocumentStyle
     * @covers ::setDocumentStyle
     */
    public function testProperyDocumentStyle()
    {
        $value = new \Urbania\AppleNews\Format\DocumentStyle();
        $object = new ArticleDocument();
        $object->setDocumentStyle($value);

        $this->assertEquals($value, $object->getDocumentStyle());
    }

    /**
     * Test the property textStyles
     * @test
     * @covers ::getTextStyles
     * @covers ::setTextStyles
     */
    public function testProperyTextStyles()
    {
        $value = new \Urbania\AppleNews\Format\TextStyles();
        $object = new ArticleDocument();
        $object->setTextStyles($value);

        $this->assertEquals($value, $object->getTextStyles());
    }

    /**
     * Test the property componentLayouts
     * @test
     * @covers ::getComponentLayouts
     * @covers ::setComponentLayouts
     */
    public function testProperyComponentLayouts()
    {
        $value = new \Urbania\AppleNews\Format\ComponentLayouts();
        $object = new ArticleDocument();
        $object->setComponentLayouts($value);

        $this->assertEquals($value, $object->getComponentLayouts());
    }

    /**
     * Test the property componentStyles
     * @test
     * @covers ::getComponentStyles
     * @covers ::setComponentStyles
     */
    public function testProperyComponentStyles()
    {
        $value = new \Urbania\AppleNews\Format\ComponentStyles();
        $object = new ArticleDocument();
        $object->setComponentStyles($value);

        $this->assertEquals($value, $object->getComponentStyles());
    }
}
