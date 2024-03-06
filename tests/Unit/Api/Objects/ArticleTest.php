<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\Article;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\Article
 */
class ArticleTest extends TestCase
{
    /**
     * Test the property accessoryText
     * @test
     * @dataProvider accessoryTextProvider
     * @covers ::getAccessoryText
     * @covers ::setAccessoryText
     */
    public function testPropertyAccessoryText($value)
    {
        $object = new Article();
        $object->setAccessoryText($value);

        $this->assertEquals($value, $object->getAccessoryText());
    }

    /**
     * Data provider for property accessoryText
     */
    public static function accessoryTextProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property createdAt
     * @test
     * @dataProvider createdAtProvider
     * @covers ::getCreatedAt
     * @covers ::setCreatedAt
     */
    public function testPropertyCreatedAt($value)
    {
        $object = new Article();
        $object->setCreatedAt($value);

        $this->assertEquals($value, $object->getCreatedAt());
    }

    /**
     * Data provider for property createdAt
     */
    public static function createdAtProvider()
    {
        return [[null]];
    }

    /**
     * Test the property document
     * @test
     * @dataProvider documentProvider
     * @covers ::getDocument
     * @covers ::setDocument
     */
    public function testPropertyDocument($value)
    {
        $object = new Article();
        $object->setDocument($value);

        $this->assertEquals($value, $object->getDocument());
    }

    /**
     * Data provider for property document
     */
    public static function documentProvider()
    {
        return [[new \Urbania\AppleNews\Format\ArticleDocument()], ['a string']];
    }

    /**
     * Test the property id
     * @test
     * @dataProvider idProvider
     * @covers ::getId
     * @covers ::setId
     */
    public function testPropertyId($value)
    {
        $object = new Article();
        $object->setId($value);

        $this->assertEquals($value, $object->getId());
    }

    /**
     * Data provider for property id
     */
    public static function idProvider()
    {
        return [['5a08115e-dbd5-11ee-ac6c-ca53fbc83398']];
    }

    /**
     * Test the property isCandidateToBeFeatured
     * @test
     * @dataProvider isCandidateToBeFeaturedProvider
     * @covers ::getIsCandidateToBeFeatured
     * @covers ::setIsCandidateToBeFeatured
     */
    public function testPropertyIsCandidateToBeFeatured($value)
    {
        $object = new Article();
        $object->setIsCandidateToBeFeatured($value);

        $this->assertEquals($value, $object->getIsCandidateToBeFeatured());
    }

    /**
     * Data provider for property isCandidateToBeFeatured
     */
    public static function isCandidateToBeFeaturedProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property isPreview
     * @test
     * @dataProvider isPreviewProvider
     * @covers ::getIsPreview
     * @covers ::setIsPreview
     */
    public function testPropertyIsPreview($value)
    {
        $object = new Article();
        $object->setIsPreview($value);

        $this->assertEquals($value, $object->getIsPreview());
    }

    /**
     * Data provider for property isPreview
     */
    public static function isPreviewProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property isSponsored
     * @test
     * @dataProvider isSponsoredProvider
     * @covers ::getIsSponsored
     * @covers ::setIsSponsored
     */
    public function testPropertyIsSponsored($value)
    {
        $object = new Article();
        $object->setIsSponsored($value);

        $this->assertEquals($value, $object->getIsSponsored());
    }

    /**
     * Data provider for property isSponsored
     */
    public static function isSponsoredProvider()
    {
        return [[true], [false]];
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
        $object = new Article();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public static function linksProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\ArticleLinksResponse()]];
    }

    /**
     * Test the property maturityRating
     * @test
     * @dataProvider maturityRatingProvider
     * @covers ::getMaturityRating
     * @covers ::setMaturityRating
     */
    public function testPropertyMaturityRating($value)
    {
        $object = new Article();
        $object->setMaturityRating($value);

        $this->assertEquals($value, $object->getMaturityRating());
    }

    /**
     * Data provider for property maturityRating
     */
    public static function maturityRatingProvider()
    {
        return [['KIDS'], ['MATURE'], ['GENERAL']];
    }

    /**
     * Test the property modifiedAt
     * @test
     * @dataProvider modifiedAtProvider
     * @covers ::getModifiedAt
     * @covers ::setModifiedAt
     */
    public function testPropertyModifiedAt($value)
    {
        $object = new Article();
        $object->setModifiedAt($value);

        $this->assertEquals($value, $object->getModifiedAt());
    }

    /**
     * Data provider for property modifiedAt
     */
    public static function modifiedAtProvider()
    {
        return [[null]];
    }

    /**
     * Test the property revision
     * @test
     * @dataProvider revisionProvider
     * @covers ::getRevision
     * @covers ::setRevision
     */
    public function testPropertyRevision($value)
    {
        $object = new Article();
        $object->setRevision($value);

        $this->assertEquals($value, $object->getRevision());
    }

    /**
     * Data provider for property revision
     */
    public static function revisionProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property shareUrl
     * @test
     * @dataProvider shareUrlProvider
     * @covers ::getShareUrl
     * @covers ::setShareUrl
     */
    public function testPropertyShareUrl($value)
    {
        $object = new Article();
        $object->setShareUrl($value);

        $this->assertEquals($value, $object->getShareUrl());
    }

    /**
     * Data provider for property shareUrl
     */
    public static function shareUrlProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property state
     * @test
     * @dataProvider stateProvider
     * @covers ::getState
     * @covers ::setState
     */
    public function testPropertyState($value)
    {
        $object = new Article();
        $object->setState($value);

        $this->assertEquals($value, $object->getState());
    }

    /**
     * Data provider for property state
     */
    public static function stateProvider()
    {
        return [
            ['PROCESSING'],
            ['LIVE'],
            ['PROCESSING_UPDATE'],
            ['TAKEN_DOWN'],
            ['FAILED_PROCESSING'],
            ['FAILED_PROCESSING_UPDATE'],
            ['DUPLICATE'],
        ];
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
        $object = new Article();
        $object->setTitle($value);

        $this->assertEquals($value, $object->getTitle());
    }

    /**
     * Data provider for property title
     */
    public static function titleProvider()
    {
        return [['a string']];
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
        $object = new Article();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property warnings
     * @test
     * @dataProvider warningsProvider
     * @covers ::getWarnings
     * @covers ::setWarnings
     */
    public function testPropertyWarnings($value)
    {
        $object = new Article();
        $object->setWarnings($value);

        $this->assertEquals($value, $object->getWarnings());
    }

    /**
     * Data provider for property warnings
     */
    public static function warningsProvider()
    {
        return [[[new \Urbania\AppleNews\Api\Objects\Warning()]]];
    }
}
