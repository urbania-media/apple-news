<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the metadata fields for the update article request.
 *
 * @see https://developer.apple.com/documentation/apple_news/update_article_metadata_fields
 */
class UpdateArticleMetadataFields implements \JsonSerializable
{
    /**
     * Text to include below the article excerpt in the channel view, such as
     * a byline or category label.
     * @var string
     */
    protected $accessoryText;

    /**
     * Indicates whether or not this article should be considered for
     * featuring in News. See Creating Articles for Featured Stories.
     * @var boolean
     */
    protected $isCandidateToBeFeatured;

    /**
     * Indicates whether or not the article should be temporarily hidden from
     * display in the News feed.
     * @var boolean
     */
    protected $isHidden;

    /**
     * Indicates whether this article should be public (live) or should be a
     * preview that is only visible to members of your channel. Set isPreview
     * to false to publish the article right away and make it visible to all
     * News users.
     * If your channel has not yet been approved to publish articles in Apple
     * News Format, setting isPreview to false will result in an
     * ONLY_PREVIEW_ALLOWED error.
     * Default value: true if your channel has not yet been approved to
     * publish articles in Apple News Format; false if your channel has been
     * approved.
     * @var boolean
     */
    protected $isPreview;

    /**
     * Indicates whether this article consists of sponsored content for
     * promotional purposes. Sponsored content must be marked as such;
     * channels that do not follow this policy may be suspended.
     * @var boolean
     */
    protected $isSponsored;

    /**
     * Indicates the viewing audience for the content. Note that a MATURE
     * rating indicates explicit content that is appropriate for a specific
     * audience only.
     * @var string
     */
    protected $maturityRating;

    /**
     * The current revision token for the article. The value of this field
     * must match the latest revision from an earlier Create, Read, or Update
     * Article call. This field prevents multiple users from updating an
     * article simultaneously, which would result in data loss.
     * @var string
     */
    protected $revision;

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

        if (isset($data['maturityRating'])) {
            $this->setMaturityRating($data['maturityRating']);
        }

        if (isset($data['revision'])) {
            $this->setRevision($data['revision']);
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
        Assert::boolean($isSponsored);

        $this->isSponsored = $isSponsored;
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
        Assert::oneOf($maturityRating, ["KIDS", "MATURE", "GENERAL"]);

        $this->maturityRating = $maturityRating;
        return $this;
    }

    /**
     * Get the revision
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set the revision
     * @param string $revision
     * @return $this
     */
    public function setRevision($revision)
    {
        Assert::string($revision);

        $this->revision = $revision;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
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
        if (isset($this->maturityRating)) {
            $data['maturityRating'] = $this->maturityRating;
        }
        if (isset($this->revision)) {
            $data['revision'] = $this->revision;
        }
        return $data;
    }
}
