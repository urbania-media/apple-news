<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * Information about your article, including author name, creation date,
 * publication date, keywords, and excerpt.
 *
 * @see https://developer.apple.com/documentation/apple_news/metadata
 */
class Metadata extends BaseSdkObject
{
    /**
     * The authors of this article, who may or may not be shown in the byline
     * component.
     * @var string[]
     */
    protected $authors;

    /**
     * A set of key-value pairs that can be leveraged to target your
     * advertising campaigns to specific articles or groups of articles. See
     * Targeting in the Advertising Guide for News Publishers.
     * @var \Urbania\AppleNews\Format\CampaignData
     */
    protected $campaignData;

    /**
     * The canonical URL of a web version of this article. If this Apple News
     * Format document corresponds to a web version of this article, set this
     * property to the URL of the web article. This property can be used to
     * point to one version of the article as well as to redirect devices
     * that do not support News content.
     * @var uri
     */
    protected $canonicalURL;

    /**
     * An array containing image URLs for cover art used in the Featured
     * Stories section of the For You feed. See Creating Articles for
     * Featured Stories.
     * @var Format\CoverArt[]
     */
    protected $coverArt;

    /**
     * The UTC date in ISO 8601 format (YYYY-MM-DDTHH:mm:ss±ZZ:ZZ) on which
     * this article was created. This value may or may not be the same as
     * datePublished.
     * @var \Carbon\Carbon
     */
    protected $dateCreated;

    /**
     * The UTC date in ISO 8601 format (YYYY-MM-DDTHH:mm:ss±ZZ:ZZ) on which
     * this article was last modified after it was published.
     * @var \Carbon\Carbon
     */
    protected $dateModified;

    /**
     * The UTC date in ISO 8601 format (YYYY-MM-DDTHH:mm:ss±ZZ:ZZ) on which
     * this article was first published. This date is used in the feed.
     * Include this date when posting older content to make sure the articles
     * don’t appear at the top of your feed.
     * @var \Carbon\Carbon
     */
    protected $datePublished;

    /**
     * Some text representing your article. Typically it matches the first
     * portion of the article content. It can also be an article summary.
     * Although this property is optional, it’s best to define it in all of
     * your Apple News Format documents.
     * @var string
     */
    protected $excerpt;

    /**
     * A unique identifier for the generator used to create or provide this
     * JSON document.
     * @var string
     */
    protected $generatorIdentifier;

    /**
     * The name of the generator or system that was used to create the JSON
     * document.
     * @var string
     */
    protected $generatorName;

    /**
     * The version “number,” as a string, of the generator used to create
     * the JSON document.
     * @var string
     */
    protected $generatorVersion;

    /**
     * Keywords that describe this article. You can define up to 50 keywords.
     * @var string[]
     */
    protected $keywords;

    /**
     * An array of links to other articles in Apple News.
     * @var Format\LinkedArticle[]
     */
    protected $links;

    /**
     * The URL of an image that can represent this article in a News feed
     * view (channel, topic, or For You). For best results, provide a
     * high-resolution image. The image will automatically be scaled down to
     * the correct size.
     * @var string
     */
    protected $thumbnailURL;

    /**
     * A Boolean value that indicates whether this article should be shown
     * with a transparent top toolbar that is overlaid on the the top portion
     * of the article.
     * @var boolean
     */
    protected $transparentToolbar;

    /**
     * Defines the URL for the video that represents this article. A glyph
     * will appear on the thumbnail of the article tile, allowing the video
     * to be playable from For You, topic, and channel feeds.
     * @var uri
     */
    protected $videoURL;

    public function __construct(array $data = [])
    {
        if (isset($data['authors'])) {
            $this->setAuthors($data['authors']);
        }

        if (isset($data['campaignData'])) {
            $this->setCampaignData($data['campaignData']);
        }

        if (isset($data['canonicalURL'])) {
            $this->setCanonicalURL($data['canonicalURL']);
        }

        if (isset($data['coverArt'])) {
            $this->setCoverArt($data['coverArt']);
        }

        if (isset($data['dateCreated'])) {
            $this->setDateCreated($data['dateCreated']);
        }

        if (isset($data['dateModified'])) {
            $this->setDateModified($data['dateModified']);
        }

        if (isset($data['datePublished'])) {
            $this->setDatePublished($data['datePublished']);
        }

        if (isset($data['excerpt'])) {
            $this->setExcerpt($data['excerpt']);
        }

        if (isset($data['generatorIdentifier'])) {
            $this->setGeneratorIdentifier($data['generatorIdentifier']);
        }

        if (isset($data['generatorName'])) {
            $this->setGeneratorName($data['generatorName']);
        }

        if (isset($data['generatorVersion'])) {
            $this->setGeneratorVersion($data['generatorVersion']);
        }

        if (isset($data['keywords'])) {
            $this->setKeywords($data['keywords']);
        }

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }

        if (isset($data['thumbnailURL'])) {
            $this->setThumbnailURL($data['thumbnailURL']);
        }

        if (isset($data['transparentToolbar'])) {
            $this->setTransparentToolbar($data['transparentToolbar']);
        }

        if (isset($data['videoURL'])) {
            $this->setVideoURL($data['videoURL']);
        }
    }

    /**
     * Get the authors
     * @return string[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set the authors
     * @param string[] $authors
     * @return $this
     */
    public function setAuthors($authors)
    {
        if (is_null($authors)) {
            $this->authors = null;
            return $this;
        }

        Assert::isArray($authors);
        Assert::allString($authors);

        $this->authors = $authors;
        return $this;
    }

    /**
     * Get the campaignData
     * @return \Urbania\AppleNews\Format\CampaignData
     */
    public function getCampaignData()
    {
        return $this->campaignData;
    }

    /**
     * Set the campaignData
     * @param \Urbania\AppleNews\Format\CampaignData|array $campaignData
     * @return $this
     */
    public function setCampaignData($campaignData)
    {
        if (is_null($campaignData)) {
            $this->campaignData = null;
            return $this;
        }

        if (is_object($campaignData)) {
            Assert::isInstanceOf($campaignData, CampaignData::class);
        } else {
            Assert::isArray($campaignData);
        }

        $this->campaignData = is_array($campaignData)
            ? new CampaignData($campaignData)
            : $campaignData;
        return $this;
    }

    /**
     * Get the canonicalURL
     * @return uri
     */
    public function getCanonicalURL()
    {
        return $this->canonicalURL;
    }

    /**
     * Set the canonicalURL
     * @param uri $canonicalURL
     * @return $this
     */
    public function setCanonicalURL($canonicalURL)
    {
        if (is_null($canonicalURL)) {
            $this->canonicalURL = null;
            return $this;
        }

        Assert::uri($canonicalURL);

        $this->canonicalURL = $canonicalURL;
        return $this;
    }

    /**
     * Get the coverArt
     * @return Format\CoverArt[]
     */
    public function getCoverArt()
    {
        return $this->coverArt;
    }

    /**
     * Set the coverArt
     * @param Format\CoverArt[] $coverArt
     * @return $this
     */
    public function setCoverArt($coverArt)
    {
        if (is_null($coverArt)) {
            $this->coverArt = null;
            return $this;
        }

        Assert::isArray($coverArt);
        Assert::allIsInstanceOfOrArray($coverArt, CoverArt::class);

        $items = [];
        foreach ($coverArt as $key => $item) {
            $items[$key] = is_array($item) ? new CoverArt($item) : $item;
        }
        $this->coverArt = $items;
        return $this;
    }

    /**
     * Get the dateCreated
     * @return \Carbon\Carbon
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set the dateCreated
     * @param \Carbon\Carbon|string $dateCreated
     * @return $this
     */
    public function setDateCreated($dateCreated)
    {
        if (is_null($dateCreated)) {
            $this->dateCreated = null;
            return $this;
        }

        Assert::isDate($dateCreated);

        $this->dateCreated = is_string($dateCreated)
            ? Carbon::parse($dateCreated)
            : $dateCreated;
        return $this;
    }

    /**
     * Get the dateModified
     * @return \Carbon\Carbon
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set the dateModified
     * @param \Carbon\Carbon|string $dateModified
     * @return $this
     */
    public function setDateModified($dateModified)
    {
        if (is_null($dateModified)) {
            $this->dateModified = null;
            return $this;
        }

        Assert::isDate($dateModified);

        $this->dateModified = is_string($dateModified)
            ? Carbon::parse($dateModified)
            : $dateModified;
        return $this;
    }

    /**
     * Get the datePublished
     * @return \Carbon\Carbon
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set the datePublished
     * @param \Carbon\Carbon|string $datePublished
     * @return $this
     */
    public function setDatePublished($datePublished)
    {
        if (is_null($datePublished)) {
            $this->datePublished = null;
            return $this;
        }

        Assert::isDate($datePublished);

        $this->datePublished = is_string($datePublished)
            ? Carbon::parse($datePublished)
            : $datePublished;
        return $this;
    }

    /**
     * Get the excerpt
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set the excerpt
     * @param string $excerpt
     * @return $this
     */
    public function setExcerpt($excerpt)
    {
        if (is_null($excerpt)) {
            $this->excerpt = null;
            return $this;
        }

        Assert::string($excerpt);

        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * Get the generatorIdentifier
     * @return string
     */
    public function getGeneratorIdentifier()
    {
        return $this->generatorIdentifier;
    }

    /**
     * Set the generatorIdentifier
     * @param string $generatorIdentifier
     * @return $this
     */
    public function setGeneratorIdentifier($generatorIdentifier)
    {
        if (is_null($generatorIdentifier)) {
            $this->generatorIdentifier = null;
            return $this;
        }

        Assert::string($generatorIdentifier);

        $this->generatorIdentifier = $generatorIdentifier;
        return $this;
    }

    /**
     * Get the generatorName
     * @return string
     */
    public function getGeneratorName()
    {
        return $this->generatorName;
    }

    /**
     * Set the generatorName
     * @param string $generatorName
     * @return $this
     */
    public function setGeneratorName($generatorName)
    {
        if (is_null($generatorName)) {
            $this->generatorName = null;
            return $this;
        }

        Assert::string($generatorName);

        $this->generatorName = $generatorName;
        return $this;
    }

    /**
     * Get the generatorVersion
     * @return string
     */
    public function getGeneratorVersion()
    {
        return $this->generatorVersion;
    }

    /**
     * Set the generatorVersion
     * @param string $generatorVersion
     * @return $this
     */
    public function setGeneratorVersion($generatorVersion)
    {
        if (is_null($generatorVersion)) {
            $this->generatorVersion = null;
            return $this;
        }

        Assert::string($generatorVersion);

        $this->generatorVersion = $generatorVersion;
        return $this;
    }

    /**
     * Get the keywords
     * @return string[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set the keywords
     * @param string[] $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        if (is_null($keywords)) {
            $this->keywords = null;
            return $this;
        }

        Assert::isArray($keywords);
        Assert::allString($keywords);

        $this->keywords = $keywords;
        return $this;
    }

    /**
     * Get the links
     * @return Format\LinkedArticle[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param Format\LinkedArticle[] $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        Assert::isArray($links);
        Assert::allIsInstanceOfOrArray($links, LinkedArticle::class);

        $items = [];
        foreach ($links as $key => $item) {
            $items[$key] = is_array($item) ? new LinkedArticle($item) : $item;
        }
        $this->links = $items;
        return $this;
    }

    /**
     * Get the thumbnailURL
     * @return string
     */
    public function getThumbnailURL()
    {
        return $this->thumbnailURL;
    }

    /**
     * Set the thumbnailURL
     * @param string $thumbnailURL
     * @return $this
     */
    public function setThumbnailURL($thumbnailURL)
    {
        if (is_null($thumbnailURL)) {
            $this->thumbnailURL = null;
            return $this;
        }

        Assert::string($thumbnailURL);

        $this->thumbnailURL = $thumbnailURL;
        return $this;
    }

    /**
     * Get the transparentToolbar
     * @return boolean
     */
    public function getTransparentToolbar()
    {
        return $this->transparentToolbar;
    }

    /**
     * Set the transparentToolbar
     * @param boolean $transparentToolbar
     * @return $this
     */
    public function setTransparentToolbar($transparentToolbar)
    {
        if (is_null($transparentToolbar)) {
            $this->transparentToolbar = null;
            return $this;
        }

        Assert::boolean($transparentToolbar);

        $this->transparentToolbar = $transparentToolbar;
        return $this;
    }

    /**
     * Get the videoURL
     * @return uri
     */
    public function getVideoURL()
    {
        return $this->videoURL;
    }

    /**
     * Set the videoURL
     * @param uri $videoURL
     * @return $this
     */
    public function setVideoURL($videoURL)
    {
        if (is_null($videoURL)) {
            $this->videoURL = null;
            return $this;
        }

        Assert::uri($videoURL);

        $this->videoURL = $videoURL;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->authors)) {
            $data['authors'] = $this->authors;
        }
        if (isset($this->campaignData)) {
            $data['campaignData'] = is_object($this->campaignData)
                ? $this->campaignData->toArray()
                : $this->campaignData;
        }
        if (isset($this->canonicalURL)) {
            $data['canonicalURL'] = $this->canonicalURL;
        }
        if (isset($this->coverArt)) {
            $data['coverArt'] = !is_null($this->coverArt)
                ? array_reduce(
                    array_keys($this->coverArt),
                    function ($items, $key) {
                        $items[$key] = is_object($this->coverArt[$key])
                            ? $this->coverArt[$key]->toArray()
                            : $this->coverArt[$key];
                        return $items;
                    },
                    []
                )
                : $this->coverArt;
        }
        if (isset($this->dateCreated)) {
            $data['dateCreated'] = !is_null($this->dateCreated)
                ? $this->dateCreated->toIso8601String()
                : null;
        }
        if (isset($this->dateModified)) {
            $data['dateModified'] = !is_null($this->dateModified)
                ? $this->dateModified->toIso8601String()
                : null;
        }
        if (isset($this->datePublished)) {
            $data['datePublished'] = !is_null($this->datePublished)
                ? $this->datePublished->toIso8601String()
                : null;
        }
        if (isset($this->excerpt)) {
            $data['excerpt'] = $this->excerpt;
        }
        if (isset($this->generatorIdentifier)) {
            $data['generatorIdentifier'] = $this->generatorIdentifier;
        }
        if (isset($this->generatorName)) {
            $data['generatorName'] = $this->generatorName;
        }
        if (isset($this->generatorVersion)) {
            $data['generatorVersion'] = $this->generatorVersion;
        }
        if (isset($this->keywords)) {
            $data['keywords'] = $this->keywords;
        }
        if (isset($this->links)) {
            $data['links'] = !is_null($this->links)
                ? array_reduce(
                    array_keys($this->links),
                    function ($items, $key) {
                        $items[$key] = is_object($this->links[$key])
                            ? $this->links[$key]->toArray()
                            : $this->links[$key];
                        return $items;
                    },
                    []
                )
                : $this->links;
        }
        if (isset($this->thumbnailURL)) {
            $data['thumbnailURL'] = $this->thumbnailURL;
        }
        if (isset($this->transparentToolbar)) {
            $data['transparentToolbar'] = $this->transparentToolbar;
        }
        if (isset($this->videoURL)) {
            $data['videoURL'] = $this->videoURL;
        }
        return $data;
    }
}
