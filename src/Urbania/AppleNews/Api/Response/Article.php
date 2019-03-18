<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

class Article extends Response
{
    const MATURITY_RATING_KIDS = 'KIDS';
    const MATURITY_RATING_MATURE = 'MATURE';
    const MATURITY_RATING_GENERAL = 'GENERAL';
    const STATE_PROCESSING = 'PROCESSING';
    const STATE_LIVE = 'LIVE';
    const STATE_PROCESSING_UPDATE = 'PROCESSING_UPDATE';
    const STATE_TAKEN_DOWN = 'TAKEN_DOWN';
    const STATE_FAILED_PROCESSING = 'FAILED_PROCESSING';
    const STATE_FAILED_PROCESSING_UPDATE = 'FAILED_PROCESSING_UPDATE';

    /** @var string */
    protected $id;

    /** @var string */
    protected $type = 'Article';

    /** @var string The title of the article, as specified in the Apple News Format document. */
    protected $title;

    /** @var string */
    protected $accessoryText;

    /** @var string */
    protected $document;

    /** @var string */
    protected $revision;

    /** @var string */
    protected $shareUrl;

    /** @var string */
    protected $maturityRating;

    /** @var string */
    protected $state;

    /** @var boolean */
    protected $isCandidateToBeFeatured = false;

    /** @var boolean */
    protected $isPreview = true;

    /** @var boolean */
    protected $isSponsored = false;

    /** @var \Carbon\Carbon */
    protected $modifiedAt;

    /** @var \Carbon\Carbon */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['title'])) {
            $this->setTitle($data['title']);
        }

        if (isset($data['accessoryText'])) {
            $this->setAccessoryText($data['accessoryText']);
        }

        if (isset($data['document'])) {
            $this->setDocument($data['document']);
        }

        if (isset($data['revision'])) {
            $this->setRevision($data['revision']);
        }

        if (isset($data['shareUrl'])) {
            $this->setShareUrl($data['shareUrl']);
        }

        if (isset($data['maturityRating'])) {
            $this->setMaturityRating($data['maturityRating']);
        }

        if (isset($data['state'])) {
            $this->setState($data['state']);
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

        if (isset($data['modifiedAt'])) {
            $this->setModifiedAt($data['modifiedAt']);
        }

        if (isset($data['createdAt'])) {
            $this->setCreatedAt($data['createdAt']);
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
        if (is_object($createdAt)) {
            Assert::isInstanceOf($createdAt, Carbon::class);
        } else {
            Assert::string($createdAt);
            Assert::regex(
                $createdAt,
                '/^(-?(?:[1-9][0-9]*)?[0-9]{4})-(1[0-2]|0[1-9])-(3[01]|0[1-9]|[12][0-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])(\.[0-9]+)?(Z)?$/'
            );
        }

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
        Assert::string($id);

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
        Assert::oneOf($maturityRating, [
            static::MATURITY_RATING_KIDS,
            static::MATURITY_RATING_MATURE,
            static::MATURITY_RATING_GENERAL
        ]);

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
        if (is_object($modifiedAt)) {
            Assert::isInstanceOf($modifiedAt, Carbon::class);
        } else {
            Assert::string($modifiedAt);
            Assert::regex(
                $modifiedAt,
                '/^(-?(?:[1-9][0-9]*)?[0-9]{4})-(1[0-2]|0[1-9])-(3[01]|0[1-9]|[12][0-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])(\.[0-9]+)?(Z)?$/'
            );
        }

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
            static::STATE_PROCESSING,
            static::STATE_LIVE,
            static::STATE_PROCESSING_UPDATE,
            static::STATE_TAKEN_DOWN,
            static::STATE_FAILED_PROCESSING,
            static::STATE_FAILED_PROCESSING_UPDATE
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'accessoryText' => $this->accessoryText,
            'document' => $this->document,
            'revision' => $this->revision,
            'shareUrl' => $this->shareUrl,
            'maturityRating' => $this->maturityRating,
            'state' => $this->state,
            'isCandidateToBeFeatured' => $this->isCandidateToBeFeatured,
            'isPreview' => $this->isPreview,
            'isSponsored' => $this->isSponsored,
            'modifiedAt' => !is_null($this->modifiedAt)
                ? $this->modifiedAt->toIso8601String()
                : null,
            'createdAt' => !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null
        ];
    }
}
