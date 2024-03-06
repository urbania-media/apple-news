<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Metadata;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Metadata
 */
class MetadataTest extends TestCase
{
    /**
     * Test the property authors
     * @test
     * @dataProvider authorsProvider
     * @covers ::getAuthors
     * @covers ::setAuthors
     */
    public function testPropertyAuthors($value)
    {
        $object = new Metadata();
        $object->setAuthors($value);

        $this->assertEquals($value, $object->getAuthors());
    }

    /**
     * Data provider for property authors
     */
    public static function authorsProvider()
    {
        return [[[]]];
    }

    /**
     * Test the property campaignData
     * @test
     * @dataProvider campaignDataProvider
     * @covers ::getCampaignData
     * @covers ::setCampaignData
     */
    public function testPropertyCampaignData($value)
    {
        $object = new Metadata();
        $object->setCampaignData($value);

        $this->assertEquals($value, $object->getCampaignData());
    }

    /**
     * Data provider for property campaignData
     */
    public static function campaignDataProvider()
    {
        return [[new \Urbania\AppleNews\Format\CampaignData()]];
    }

    /**
     * Test the property canonicalURL
     * @test
     * @dataProvider canonicalURLProvider
     * @covers ::getCanonicalURL
     * @covers ::setCanonicalURL
     */
    public function testPropertyCanonicalURL($value)
    {
        $object = new Metadata();
        $object->setCanonicalURL($value);

        $this->assertEquals($value, $object->getCanonicalURL());
    }

    /**
     * Data provider for property canonicalURL
     */
    public static function canonicalURLProvider()
    {
        return [['http://example.com'], ['https://example.com']];
    }

    /**
     * Test the property contentGenerationType
     * @test
     * @dataProvider contentGenerationTypeProvider
     * @covers ::getContentGenerationType
     * @covers ::setContentGenerationType
     */
    public function testPropertyContentGenerationType($value)
    {
        $object = new Metadata();
        $object->setContentGenerationType($value);

        $this->assertEquals($value, $object->getContentGenerationType());
    }

    /**
     * Data provider for property contentGenerationType
     */
    public static function contentGenerationTypeProvider()
    {
        return [['AI']];
    }

    /**
     * Test the property dateCreated
     * @test
     * @dataProvider dateCreatedProvider
     * @covers ::getDateCreated
     * @covers ::setDateCreated
     */
    public function testPropertyDateCreated($value)
    {
        $object = new Metadata();
        $object->setDateCreated($value);

        $this->assertEquals($value, $object->getDateCreated());
    }

    /**
     * Data provider for property dateCreated
     */
    public static function dateCreatedProvider()
    {
        return [[null]];
    }

    /**
     * Test the property dateModified
     * @test
     * @dataProvider dateModifiedProvider
     * @covers ::getDateModified
     * @covers ::setDateModified
     */
    public function testPropertyDateModified($value)
    {
        $object = new Metadata();
        $object->setDateModified($value);

        $this->assertEquals($value, $object->getDateModified());
    }

    /**
     * Data provider for property dateModified
     */
    public static function dateModifiedProvider()
    {
        return [[null]];
    }

    /**
     * Test the property datePublished
     * @test
     * @dataProvider datePublishedProvider
     * @covers ::getDatePublished
     * @covers ::setDatePublished
     */
    public function testPropertyDatePublished($value)
    {
        $object = new Metadata();
        $object->setDatePublished($value);

        $this->assertEquals($value, $object->getDatePublished());
    }

    /**
     * Data provider for property datePublished
     */
    public static function datePublishedProvider()
    {
        return [[null]];
    }

    /**
     * Test the property excerpt
     * @test
     * @dataProvider excerptProvider
     * @covers ::getExcerpt
     * @covers ::setExcerpt
     */
    public function testPropertyExcerpt($value)
    {
        $object = new Metadata();
        $object->setExcerpt($value);

        $this->assertEquals($value, $object->getExcerpt());
    }

    /**
     * Data provider for property excerpt
     */
    public static function excerptProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property generatorIdentifier
     * @test
     * @dataProvider generatorIdentifierProvider
     * @covers ::getGeneratorIdentifier
     * @covers ::setGeneratorIdentifier
     */
    public function testPropertyGeneratorIdentifier($value)
    {
        $object = new Metadata();
        $object->setGeneratorIdentifier($value);

        $this->assertEquals($value, $object->getGeneratorIdentifier());
    }

    /**
     * Data provider for property generatorIdentifier
     */
    public static function generatorIdentifierProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property generatorName
     * @test
     * @dataProvider generatorNameProvider
     * @covers ::getGeneratorName
     * @covers ::setGeneratorName
     */
    public function testPropertyGeneratorName($value)
    {
        $object = new Metadata();
        $object->setGeneratorName($value);

        $this->assertEquals($value, $object->getGeneratorName());
    }

    /**
     * Data provider for property generatorName
     */
    public static function generatorNameProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property generatorVersion
     * @test
     * @dataProvider generatorVersionProvider
     * @covers ::getGeneratorVersion
     * @covers ::setGeneratorVersion
     */
    public function testPropertyGeneratorVersion($value)
    {
        $object = new Metadata();
        $object->setGeneratorVersion($value);

        $this->assertEquals($value, $object->getGeneratorVersion());
    }

    /**
     * Data provider for property generatorVersion
     */
    public static function generatorVersionProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property issue
     * @test
     * @dataProvider issueProvider
     * @covers ::getIssue
     * @covers ::setIssue
     */
    public function testPropertyIssue($value)
    {
        $object = new Metadata();
        $object->setIssue($value);

        $this->assertEquals($value, $object->getIssue());
    }

    /**
     * Data provider for property issue
     */
    public static function issueProvider()
    {
        return [[new \Urbania\AppleNews\Format\Issue()]];
    }

    /**
     * Test the property keywords
     * @test
     * @dataProvider keywordsProvider
     * @covers ::getKeywords
     * @covers ::setKeywords
     */
    public function testPropertyKeywords($value)
    {
        $object = new Metadata();
        $object->setKeywords($value);

        $this->assertEquals($value, $object->getKeywords());
    }

    /**
     * Data provider for property keywords
     */
    public static function keywordsProvider()
    {
        return [[[]]];
    }

    /**
     * Test the property links
     * @test
     * @dataProvider linksProvider
     * @covers ::getLinks
     * @covers ::setLinks
     */
    public function testPropertyLinks($value)
    {
        $object = new Metadata();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public static function linksProvider()
    {
        return [[[new \Urbania\AppleNews\Format\LinkedArticle()]]];
    }

    /**
     * Test the property thumbnailURL
     * @test
     * @dataProvider thumbnailURLProvider
     * @covers ::getThumbnailURL
     * @covers ::setThumbnailURL
     */
    public function testPropertyThumbnailURL($value)
    {
        $object = new Metadata();
        $object->setThumbnailURL($value);

        $this->assertEquals($value, $object->getThumbnailURL());
    }

    /**
     * Data provider for property thumbnailURL
     */
    public static function thumbnailURLProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property transparentToolbar
     * @test
     * @dataProvider transparentToolbarProvider
     * @covers ::getTransparentToolbar
     * @covers ::setTransparentToolbar
     */
    public function testPropertyTransparentToolbar($value)
    {
        $object = new Metadata();
        $object->setTransparentToolbar($value);

        $this->assertEquals($value, $object->getTransparentToolbar());
    }

    /**
     * Data provider for property transparentToolbar
     */
    public static function transparentToolbarProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property videoURL
     * @test
     * @dataProvider videoURLProvider
     * @covers ::getVideoURL
     * @covers ::setVideoURL
     */
    public function testPropertyVideoURL($value)
    {
        $object = new Metadata();
        $object->setVideoURL($value);

        $this->assertEquals($value, $object->getVideoURL());
    }

    /**
     * Data provider for property videoURL
     */
    public static function videoURLProvider()
    {
        return [['http://example.com'], ['https://example.com']];
    }
}
