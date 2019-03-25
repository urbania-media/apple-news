<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields
 */
class CreateArticleMetadataFieldsTest extends TestCase
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
        $object = new CreateArticleMetadataFields();
        $object->setAccessoryText($value);

        $this->assertEquals($value, $object->getAccessoryText());
    }

    /**
     * Data provider for property accessoryText
     */
    public function accessoryTextProvider()
    {
        return [["a string"]];
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
        $object = new CreateArticleMetadataFields();
        $object->setIsCandidateToBeFeatured($value);

        $this->assertEquals($value, $object->getIsCandidateToBeFeatured());
    }

    /**
     * Data provider for property isCandidateToBeFeatured
     */
    public function isCandidateToBeFeaturedProvider()
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
        $object = new CreateArticleMetadataFields();
        $object->setIsHidden($value);

        $this->assertEquals($value, $object->getIsHidden());
    }

    /**
     * Data provider for property isHidden
     */
    public function isHiddenProvider()
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
        $object = new CreateArticleMetadataFields();
        $object->setIsPreview($value);

        $this->assertEquals($value, $object->getIsPreview());
    }

    /**
     * Data provider for property isPreview
     */
    public function isPreviewProvider()
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
        $object = new CreateArticleMetadataFields();
        $object->setIsSponsored($value);

        $this->assertEquals($value, $object->getIsSponsored());
    }

    /**
     * Data provider for property isSponsored
     */
    public function isSponsoredProvider()
    {
        return [[true], [false]];
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
        $object = new CreateArticleMetadataFields();
        $object->setMaturityRating($value);

        $this->assertEquals($value, $object->getMaturityRating());
    }

    /**
     * Data provider for property maturityRating
     */
    public function maturityRatingProvider()
    {
        return [["KIDS"], ["MATURE"], ["GENERAL"]];
    }
}
