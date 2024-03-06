<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the fields the article endpoints returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/article.json
 */
class Article extends BaseSdkObject
{
    /**
     * Text that appears alongside article headlines — author name, channel
     * name, subtitle, and so on.
     * Maximum length: 100 characters.
     * Default value: metadata.authors from the Apple News Format article.
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
     * @var \Urbania\AppleNews\Format\ArticleDocument|string
     */
    protected $document;

    /**
     * The unique identifier of the article.
     * @var string
     */
    protected $id;

    /**
     * A Boolean value that indicates whether this article should be
     * considered for featuring in Apple News.
     * Default value: false
     * @var boolean
     */
    protected $isCandidateToBeFeatured;

    /**
     * A Boolean value that indicates whether this article should be public
     * (live) or should be a preview that’s only visible to members of your
     * channel. Set isPreview to false to publish the article immediately and
     * make it visible to all News users.
     * If your channel hasn’t been approved to publish articles in Apple
     * News Format, setting isPreview to false results in an
     * ONLY_PREVIEW_ALLOWED error.
     * Default value: true if your channel hasn’t yet been approved to
     * publish articles in Apple News Format; false if your channel has been
     * approved.
     * @var boolean
     */
    protected $isPreview;

    /**
     * A Boolean value that indicates whether this article consists of
     * sponsored content for promotional purposes. You must mark sponsored
     * content as such; channels that don’t follow this policy may be
     * suspended.
     * When using isSponsored, if you don’t want the sponsored article to
     * appear in your channel’s feed, set sections to [] (an empty array).
     * Default value: false
     * @var boolean
     */
    protected $isSponsored;

    /**
     * The URL of the channel in which the article appears.
     * @var \Urbania\AppleNews\Api\Objects\ArticleLinksResponse
     */
    protected $links;

    /**
     * A string value that indicates the viewing audience for the content.
     * The types of audiences or ratings are KIDS, MATURE, and GENERAL, or
     * null if unspecified. A MATURE rating indicates explicit content
     * that’s only appropriate for a specific audience.
     * Default value: null
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
     * You must send the latest revision when issuing a request to .
     * The value of this field must match the latest revision from an earlier
     * Create, Read, or Update Article call. This field prevents multiple
     * users from updating an article simultaneously, which results in data
     * loss.
     * Required: Yes
     * @var string
     */
    protected $revision;

    /**
     * The URL to the article within the News app.
     * @var string
     */
    protected $shareUrl;

    /**
     * The current state of the article, which can be one of the following:
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
     * The article.
     * @var string
     */
    protected $type;

    /**
     * A list of warning messages indicating nonfatal problems with the
     * article.
     * @var Api\Objects\Warning[]
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

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
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
     * Get the createdAt
     * @return \Carbon\Carbon
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the createdAt
     * @param \Carbon\Carbon|string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if (is_null($createdAt)) {
            $this->createdAt = null;
            return $this;
        }

        Assert::isDate($createdAt);

        $this->createdAt = is_string($createdAt) ? Carbon::parse($createdAt) : $createdAt;
        return $this;
    }

    /**
     * Get the document
     * @return \Urbania\AppleNews\Format\ArticleDocument|string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the document
     * @param \Urbania\AppleNews\Format\ArticleDocument|array|string $document
     * @return $this
     */
    public function setDocument($document)
    {
        if (is_null($document)) {
            $this->document = null;
            return $this;
        }

        if (is_object($document) || Utils::isAssociativeArray($document)) {
            Assert::isSdkObject($document, \Urbania\AppleNews\Format\ArticleDocument::class);
        } else {
            Assert::string($document);
        }

        $this->document = Utils::isAssociativeArray($document)
            ? new \Urbania\AppleNews\Format\ArticleDocument($document)
            : $document;
        return $this;
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
     * Set the id
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        if (is_null($id)) {
            $this->id = null;
            return $this;
        }

        Assert::uuid($id);

        $this->id = $id;
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
     * @return \Urbania\AppleNews\Api\Objects\ArticleLinksResponse
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\ArticleLinksResponse|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        Assert::isSdkObject($links, ArticleLinksResponse::class);

        $this->links = Utils::isAssociativeArray($links)
            ? new ArticleLinksResponse($links)
            : $links;
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
     * Get the modifiedAt
     * @return \Carbon\Carbon
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set the modifiedAt
     * @param \Carbon\Carbon|string $modifiedAt
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        if (is_null($modifiedAt)) {
            $this->modifiedAt = null;
            return $this;
        }

        Assert::isDate($modifiedAt);

        $this->modifiedAt = is_string($modifiedAt) ? Carbon::parse($modifiedAt) : $modifiedAt;
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
        if (is_null($revision)) {
            $this->revision = null;
            return $this;
        }

        Assert::string($revision);

        $this->revision = $revision;
        return $this;
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
     * Set the shareUrl
     * @param string $shareUrl
     * @return $this
     */
    public function setShareUrl($shareUrl)
    {
        if (is_null($shareUrl)) {
            $this->shareUrl = null;
            return $this;
        }

        Assert::string($shareUrl);

        $this->shareUrl = $shareUrl;
        return $this;
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
     * Set the state
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        if (is_null($state)) {
            $this->state = null;
            return $this;
        }

        Assert::oneOf($state, [
            'PROCESSING',
            'LIVE',
            'PROCESSING_UPDATE',
            'TAKEN_DOWN',
            'FAILED_PROCESSING',
            'FAILED_PROCESSING_UPDATE',
            'DUPLICATE',
        ]);

        $this->state = $state;
        return $this;
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
     * Set the title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            $this->title = null;
            return $this;
        }

        Assert::string($title);

        $this->title = $title;
        return $this;
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        if (is_null($type)) {
            $this->type = null;
            return $this;
        }

        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Add an item to warnings
     * @param \Urbania\AppleNews\Api\Objects\Warning|array $item
     * @return $this
     */
    public function addWarning($item)
    {
        return $this->setWarnings(
            !is_null($this->warnings) ? array_merge($this->warnings, [$item]) : [$item]
        );
    }

    /**
     * Add items to warnings
     * @param array $items
     * @return $this
     */
    public function addWarnings($items)
    {
        Assert::isArray($items);
        return $this->setWarnings(
            !is_null($this->warnings) ? array_merge($this->warnings, $items) : $items
        );
    }

    /**
     * Get the warnings
     * @return Api\Objects\Warning[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Set the warnings
     * @param Api\Objects\Warning[] $warnings
     * @return $this
     */
    public function setWarnings($warnings)
    {
        if (is_null($warnings)) {
            $this->warnings = null;
            return $this;
        }

        Assert::isArray($warnings);
        Assert::allIsSdkObject($warnings, Warning::class);

        $this->warnings = is_array($warnings)
            ? array_reduce(
                array_keys($warnings),
                function ($array, $key) use ($warnings) {
                    $item = $warnings[$key];
                    $array[$key] = Utils::isAssociativeArray($item) ? new Warning($item) : $item;
                    return $array;
                },
                []
            )
            : $warnings;
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
        if (isset($this->createdAt)) {
            $data['createdAt'] = !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null;
        }
        if (isset($this->document)) {
            $data['document'] =
                $this->document instanceof Arrayable ? $this->document->toArray() : $this->document;
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
        if (isset($this->links)) {
            $data['links'] =
                $this->links instanceof Arrayable ? $this->links->toArray() : $this->links;
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
                        $items[$key] =
                            $this->warnings[$key] instanceof Arrayable
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
