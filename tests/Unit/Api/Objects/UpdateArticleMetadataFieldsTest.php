<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields
 */
class UpdateArticleMetadataFieldsTest extends TestCase
{
    /**
     * Test the property revision
     * @test
     * @dataProvider revisionProvider
     * @covers ::getRevision
     * @covers ::setRevision
     */
    public function testPropertyRevision($value)
    {
        $object = new UpdateArticleMetadataFields();
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
     * Test the property accessoryText
     * @test
     * @dataProvider accessoryTextProvider
     * @covers ::getAccessoryText
     * @covers ::setAccessoryText
     */
    public function testPropertyAccessoryText($value)
    {
        $object = new UpdateArticleMetadataFields();
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
     * Test the property isCandidateToBeFeatured
     * @test
     * @dataProvider isCandidateToBeFeaturedProvider
     * @covers ::getIsCandidateToBeFeatured
     * @covers ::setIsCandidateToBeFeatured
     */
    public function testPropertyIsCandidateToBeFeatured($value)
    {
        $object = new UpdateArticleMetadataFields();
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
     * Test the property isHidden
     * @test
     * @dataProvider isHiddenProvider
     * @covers ::getIsHidden
     * @covers ::setIsHidden
     */
    public function testPropertyIsHidden($value)
    {
        $object = new UpdateArticleMetadataFields();
        $object->setIsHidden($value);

        $this->assertEquals($value, $object->getIsHidden());
    }

    /**
     * Data provider for property isHidden
     */
    public static function isHiddenProvider()
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
        $object = new UpdateArticleMetadataFields();
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
        $object = new UpdateArticleMetadataFields();
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
        $object = new UpdateArticleMetadataFields();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public static function linksProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\ArticleLinks()]];
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
        $object = new UpdateArticleMetadataFields();
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
     * Test the property targetTerritoryCountryCodes
     * @test
     * @dataProvider targetTerritoryCountryCodesProvider
     * @covers ::getTargetTerritoryCountryCodes
     * @covers ::setTargetTerritoryCountryCodes
     */
    public function testPropertyTargetTerritoryCountryCodes($value)
    {
        $object = new UpdateArticleMetadataFields();
        $object->setTargetTerritoryCountryCodes($value);

        $this->assertEquals($value, $object->getTargetTerritoryCountryCodes());
    }

    /**
     * Data provider for property targetTerritoryCountryCodes
     */
    public static function targetTerritoryCountryCodesProvider()
    {
        return [[[]]];
    }
}
