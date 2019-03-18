<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the fields returned by the article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/article
 */
class Article
{
    /**
     * Text that appears alongside article headlines — author name, channel
     * name, subtitle, and so on.
     * @var string
     */
    protected $accessoryText;

    /**
     * The date and time the article was created.
     * @var \Carbon\Carbon
     */
    protected $createdAt;

    /**
     * The content of the article, as an Apple News Format document.
     * @var string
     */
    protected $document;

    /**
     * The unique identifier of the article.
     * @var string
     */
    protected $id;

    /**
     * Indicates whether or not this article should be considered for
     * featuring in News. See Creating Articles for Featured Stories.
     * @var boolean
     */
    protected $isCandidateToBeFeatured;

    /**
     * Indicates whether this article should be public (live) or should be a
     * preview that is only visible to members of your channel. Set isPreview
     * to false to publish the article right away and make it visible to all
     * News users.
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
     * Indicates the viewing audience for the content. The types of audiences
     * or ratings are KIDS, MATURE, and GENERAL or null if unspecified. Note
     * that a MATURE rating indicates explicit content that is only
     * appropriate for a specific audience.
     * @var string
     */
    protected $maturityRating;

    /**
     * The date and time this article was last modified.
     * @var \Carbon\Carbon
     */
    protected $modifiedAt;

    /**
     * The current revision token for the article.
     * @var string
     */
    protected $revision;

    /**
     * The URL to the article within the News app. The shareUrl field applies
     * only on devices with iOS 9 installed.
     * @var string
     */
    protected $shareUrl;

    /**
     * The current state of the article which can be one of the following:
     * @var string
     */
    protected $state;

    /**
     * The title of the article, as specified in the Apple News Format
     * document.
     * @var string
     */
    protected $title;

    /**
     * Article
     * @var string
     */
    protected $type;

    /**
     * A list of warning messages indicating problems with the article that
     * are not fatal.
     * @var Api\Response\Warning[]
     */
    protected $warnings;

    public function __construct(array $data = [])
    {
        if (isset($data['accessoryText'])) {
            $this->setAccessoryText($data['accessoryText']);
        }

        if (isset($data['createdAt'])) {
            $this->setCreatedAt($data['createdAt']);
        }

        if (isset($data['document'])) {
            $this->setDocument($data['document']);
        }

        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['isCandidateToBeFeatured'])) {
            $this->setIsCandidateToBeFeatured($data['isCandidateToBeFeatured']);
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

        if (isset($data['modifiedAt'])) {
            $this->setModifiedAt($data['modifiedAt']);
        }

        if (isset($data['revision'])) {
            $this->setRevision($data['revision']);
        }

        if (isset($data['shareUrl'])) {
            $this->setShareUrl($data['shareUrl']);
        }

        if (isset($data['state'])) {
            $this->setState($data['state']);
        }

        if (isset($data['title'])) {
            $this->setTitle($data['title']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['warnings'])) {
            $this->setWarnings($data['warnings']);
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
     * Get the createdAt
     * @return \Carbon\Carbon
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the document
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Get the id
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * Get the isPreview
     * @return boolean
     */
    public function getIsPreview()
    {
        return $this->isPreview;
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
     * Get the maturityRating
     * @return string
     */
    public function getMaturityRating()
    {
        return $this->maturityRating;
    }

    /**
     * Get the modifiedAt
     * @return \Carbon\Carbon
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
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
     * Get the shareUrl
     * @return string
     */
    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    /**
     * Get the state
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the warnings
     * @return Api\Response\Warning[]
     */
    public function getWarnings()
    {
        return $this->warnings;
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
     * Set the createdAt
     * @param \Carbon\Carbon|string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        Assert::isDate($createdAt);

        $this->createdAt = is_string($createdAt)
            ? Carbon::parse($createdAt)
            : $createdAt;
        return $this;
    }

    /**
     * Set the document
     * @param string $document
     * @return $this
     */
    public function setDocument($document)
    {
        Assert::string($document);

        $this->document = $document;
        return $this;
    }

    /**
     * Set the id
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        Assert::uuid($id);

        $this->id = $id;
        return $this;
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
     * Set the modifiedAt
     * @param \Carbon\Carbon|string $modifiedAt
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        Assert::isDate($modifiedAt);

        $this->modifiedAt = is_string($modifiedAt)
            ? Carbon::parse($modifiedAt)
            : $modifiedAt;
        return $this;
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
     * Set the shareUrl
     * @param string $shareUrl
     * @return $this
     */
    public function setShareUrl($shareUrl)
    {
        Assert::string($shareUrl);

        $this->shareUrl = $shareUrl;
        return $this;
    }

    /**
     * Set the state
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        Assert::oneOf($state, [
            "PROCESSING",
            "LIVE",
            "PROCESSING_UPDATE",
            "TAKEN_DOWN",
            "FAILED_PROCESSING",
            "FAILED_PROCESSING_UPDATE"
        ]);

        $this->state = $state;
        return $this;
    }

    /**
     * Set the title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        Assert::string($title);

        $this->title = $title;
        return $this;
    }

    /**
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Set the warnings
     * @param Api\Response\Warning[] $warnings
     * @return $this
     */
    public function setWarnings($warnings)
    {
        Assert::isArray($warnings);
        Assert::allIsInstanceOfOrArray($warnings, Warning::class);

        $items = [];
        foreach ($warnings as $key => $item) {
            $items[$key] = is_array($item) ? new Warning($item) : $item;
        }
        $this->warnings = $items;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        if (isset($this->createdAt)) {
            $data['createdAt'] = !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null;
        }
        if (isset($this->document)) {
            $data['document'] = $this->document;
        }
        if (isset($this->id)) {
            $data['id'] = $this->id;
        }
        if (isset($this->isCandidateToBeFeatured)) {
            $data['isCandidateToBeFeatured'] = $this->isCandidateToBeFeatured;
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
        if (isset($this->modifiedAt)) {
            $data['modifiedAt'] = !is_null($this->modifiedAt)
                ? $this->modifiedAt->toIso8601String()
                : null;
        }
        if (isset($this->revision)) {
            $data['revision'] = $this->revision;
        }
        if (isset($this->shareUrl)) {
            $data['shareUrl'] = $this->shareUrl;
        }
        if (isset($this->state)) {
            $data['state'] = $this->state;
        }
        if (isset($this->title)) {
            $data['title'] = $this->title;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->warnings)) {
            $data['warnings'] = !is_null($this->warnings)
                ? array_reduce(
                    array_keys($this->warnings),
                    function ($items, $key) {
                        $items[$key] = is_object($this->warnings[$key])
                            ? $this->warnings[$key]->toArray()
                            : $this->warnings[$key];
                        return $items;
                    },
                    []
                )
                : $this->warnings;
        }
        return $data;
    }
}
