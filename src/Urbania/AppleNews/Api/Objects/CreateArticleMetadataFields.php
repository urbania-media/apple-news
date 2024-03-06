<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the optional metadata fields for the Create an Article Request.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/create_article_metadata_fields.json
 */
class CreateArticleMetadataFields extends BaseSdkObject
{
    /**
     * The text to include below the article excerpt in the channel view,
     * such as a byline or category label.
     * @var string
     */
    protected $accessoryText;

    /**
     * A Boolean that indicates whether this article should be considered for
     * featuring in Apple News.
     * @var boolean
     */
    protected $isCandidateToBeFeatured;

    /**
     * A Boolean that indicates whether the article should be temporarily
     * hidden from display in feeds in Apple News. Note that a hidden article
     * is accessible if you have a direct link to the article.
     * @var boolean
     */
    protected $isHidden;

    /**
     * A Boolean that indicates whether this article should be public (live)
     * or should be a preview that’s only visible to members of your
     * channel. Set isPreview to false to publish the article immediately and
     * make it visible to all News users.
     * If your channel hasn’t yet been approved to publish articles in
     * Apple News Format, setting isPreview to false results in an
     * ONLY_PREVIEW_ALLOWED error.
     * @var boolean
     */
    protected $isPreview;

    /**
     * A Boolean that indicates whether this article consists of sponsored
     * content for promotional purposes. You must mark sponsored content as
     * such; channels that don’t follow this policy may be suspended.
     * When using isSponsored, if you don’t want the sponsored article to
     * appear in your channel’s feed, set sections to [] (an empty array).
     * @var boolean
     */
    protected $isSponsored;

    /** @var \Urbania\AppleNews\Api\Objects\ArticleLinks */
    protected $links;

    /**
     * A string that indicates the viewing audience for the content.
     * MATURE indicates explicit content that’s only appropriate for a
     * specific audience.
     * By default, the article inherits the value you set for your channel in
     * News Publisher.
     * @var string
     */
    protected $maturityRating;

    /**
     * The target country codes required for publishing the article. You must
     * enable the specified country codes in your channel. For example, to
     * publish an article only in the United Kingdom and Australia, specify
     * GB and AU. By default, an article inherits the channel's territories.
     * Country codes must be in ISO 3166-1 alpha-2 code format; for example,
     * AU for Australia. For a complete list of ISO country codes, see .
     * If you specify a country code that isn’t defined in your channel,
     * the  ARTICLE_TERRITORY_NOT_ALLOWED error is generated. If you specify
     * an invalid country code, the server generates an
     * INVALID_ARTICLE_TERRITORY error.
     * @var string[]
     */
    protected $targetTerritoryCountryCodes;

    public function __construct(array $data = [])
    {
        if (isset($data['accessoryText'])) {
            $this->setAccessoryText($data['accessoryText']);
        }

        if (isset($data['isCandidateToBeFeatured'])) {
            $this->setIsCandidateToBeFeatured($data['isCandidateToBeFeatured']);
        }

        if (isset($data['isHidden'])) {
            $this->setIsHidden($data['isHidden']);
        }

        if (isset($data['isPreview'])) {
            $this->setIsPreview($data['isPreview']);
        }

        if (isset($data['isSponsored'])) {
            $this->setIsSponsored($data['isSponsored']);
        }

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }

        if (isset($data['maturityRating'])) {
            $this->setMaturityRating($data['maturityRating']);
        }

        if (isset($data['targetTerritoryCountryCodes'])) {
            $this->setTargetTerritoryCountryCodes($data['targetTerritoryCountryCodes']);
        }

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }
    }

    /**
     * Get the accessoryText
     * @return string
     */
    public function getAccessoryText()
    {
        return $this->accessoryText;
    }

    /**
     * Set the accessoryText
     * @param string $accessoryText
     * @return $this
     */
    public function setAccessoryText($accessoryText)
    {
        if (is_null($accessoryText)) {
            $this->accessoryText = null;
            return $this;
        }

        Assert::string($accessoryText);

        $this->accessoryText = $accessoryText;
        return $this;
    }

    /**
     * Get the isCandidateToBeFeatured
     * @return boolean
     */
    public function getIsCandidateToBeFeatured()
    {
        return $this->isCandidateToBeFeatured;
    }

    /**
     * Set the isCandidateToBeFeatured
     * @param boolean $isCandidateToBeFeatured
     * @return $this
     */
    public function setIsCandidateToBeFeatured($isCandidateToBeFeatured)
    {
        if (is_null($isCandidateToBeFeatured)) {
            $this->isCandidateToBeFeatured = null;
            return $this;
        }

        Assert::boolean($isCandidateToBeFeatured);

        $this->isCandidateToBeFeatured = $isCandidateToBeFeatured;
        return $this;
    }

    /**
     * Get the isHidden
     * @return boolean
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Set the isHidden
     * @param boolean $isHidden
     * @return $this
     */
    public function setIsHidden($isHidden)
    {
        if (is_null($isHidden)) {
            $this->isHidden = null;
            return $this;
        }

        Assert::boolean($isHidden);

        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * Get the isPreview
     * @return boolean
     */
    public function getIsPreview()
    {
        return $this->isPreview;
    }

    /**
     * Set the isPreview
     * @param boolean $isPreview
     * @return $this
     */
    public function setIsPreview($isPreview)
    {
        if (is_null($isPreview)) {
            $this->isPreview = null;
            return $this;
        }

        Assert::boolean($isPreview);

        $this->isPreview = $isPreview;
        return $this;
    }

    /**
     * Get the isSponsored
     * @return boolean
     */
    public function getIsSponsored()
    {
        return $this->isSponsored;
    }

    /**
     * Set the isSponsored
     * @param boolean $isSponsored
     * @return $this
     */
    public function setIsSponsored($isSponsored)
    {
        if (is_null($isSponsored)) {
            $this->isSponsored = null;
            return $this;
        }

        Assert::boolean($isSponsored);

        $this->isSponsored = $isSponsored;
        return $this;
    }

    /**
     * Get the links
     * @return \Urbania\AppleNews\Api\Objects\ArticleLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\ArticleLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        Assert::isSdkObject($links, ArticleLinks::class);

        $this->links = Utils::isAssociativeArray($links) ? new ArticleLinks($links) : $links;
        return $this;
    }

    /**
     * Get the maturityRating
     * @return string
     */
    public function getMaturityRating()
    {
        return $this->maturityRating;
    }

    /**
     * Set the maturityRating
     * @param string $maturityRating
     * @return $this
     */
    public function setMaturityRating($maturityRating)
    {
        if (is_null($maturityRating)) {
            $this->maturityRating = null;
            return $this;
        }

        Assert::oneOf($maturityRating, ['KIDS', 'MATURE', 'GENERAL']);

        $this->maturityRating = $maturityRating;
        return $this;
    }

    /**
     * Add an item to targetTerritoryCountryCodes
     * @param string $item
     * @return $this
     */
    public function addTargetTerritoryCountryCode($item)
    {
        return $this->setTargetTerritoryCountryCodes(
            !is_null($this->targetTerritoryCountryCodes)
                ? array_merge($this->targetTerritoryCountryCodes, [$item])
                : [$item]
        );
    }

    /**
     * Add items to targetTerritoryCountryCodes
     * @param array $items
     * @return $this
     */
    public function addTargetTerritoryCountryCodes($items)
    {
        Assert::isArray($items);
        return $this->setTargetTerritoryCountryCodes(
            !is_null($this->targetTerritoryCountryCodes)
                ? array_merge($this->targetTerritoryCountryCodes, $items)
                : $items
        );
    }

    /**
     * Get the targetTerritoryCountryCodes
     * @return string[]
     */
    public function getTargetTerritoryCountryCodes()
    {
        return $this->targetTerritoryCountryCodes;
    }

    /**
     * Set the targetTerritoryCountryCodes
     * @param string[] $targetTerritoryCountryCodes
     * @return $this
     */
    public function setTargetTerritoryCountryCodes($targetTerritoryCountryCodes)
    {
        if (is_null($targetTerritoryCountryCodes)) {
            $this->targetTerritoryCountryCodes = null;
            return $this;
        }

        Assert::isArray($targetTerritoryCountryCodes);
        Assert::allString($targetTerritoryCountryCodes);

        $this->targetTerritoryCountryCodes = $targetTerritoryCountryCodes;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->accessoryText)) {
            $data['accessoryText'] = $this->accessoryText;
        }
        if (isset($this->isCandidateToBeFeatured)) {
            $data['isCandidateToBeFeatured'] = $this->isCandidateToBeFeatured;
        }
        if (isset($this->isHidden)) {
            $data['isHidden'] = $this->isHidden;
        }
        if (isset($this->isPreview)) {
            $data['isPreview'] = $this->isPreview;
        }
        if (isset($this->isSponsored)) {
            $data['isSponsored'] = $this->isSponsored;
        }
        if (isset($this->links)) {
            $data['links'] =
                $this->links instanceof Arrayable ? $this->links->toArray() : $this->links;
        }
        if (isset($this->maturityRating)) {
            $data['maturityRating'] = $this->maturityRating;
        }
        if (isset($this->targetTerritoryCountryCodes)) {
            $data['targetTerritoryCountryCodes'] = $this->targetTerritoryCountryCodes;
        }
        if (isset($this->links)) {
            $data['links'] =
                $this->links instanceof Arrayable ? $this->links->toArray() : $this->links;
        }
        return $data;
    }
}
