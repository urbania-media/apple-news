<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Information about your article, including author name, creation date,
 * publication date, keywords, and excerpt.
 *
 * @see https://developer.apple.com/documentation/apple_news/metadata
 */
class Metadata
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
     * Get the campaignData
     * @return \Urbania\AppleNews\Format\CampaignData
     */
    public function getCampaignData()
    {
        return $this->campaignData;
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
     * Get the coverArt
     * @return Format\CoverArt[]
     */
    public function getCoverArt()
    {
        return $this->coverArt;
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
     * Get the dateModified
     * @return \Carbon\Carbon
     */
    public function getDateModified()
    {
        return $this->dateModified;
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
     * Get the excerpt
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
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
     * Get the generatorName
     * @return string
     */
    public function getGeneratorName()
    {
        return $this->generatorName;
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
     * Get the keywords
     * @return string[]
     */
    public function getKeywords()
    {
        return $this->keywords;
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
     * Get the thumbnailURL
     * @return string
     */
    public function getThumbnailURL()
    {
        return $this->thumbnailURL;
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
     * Get the videoURL
     * @return uri
     */
    public function getVideoURL()
    {
        return $this->videoURL;
    }

    /**
     * Set the authors
     * @param string[] $authors
     * @return $this
     */
    public function setAuthors($authors)
    {
        Assert::isArray($authors);
        Assert::allString($authors);

        $this->authors = $authors;
        return $this;
    }

    /**
     * Set the campaignData
     * @param \Urbania\AppleNews\Format\CampaignData|array $campaignData
     * @return $this
     */
    public function setCampaignData($campaignData)
    {
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
     * Set the canonicalURL
     * @param uri $canonicalURL
     * @return $this
     */
    public function setCanonicalURL($canonicalURL)
    {
        Assert::uri($canonicalURL);

        $this->canonicalURL = $canonicalURL;
        return $this;
    }

    /**
     * Set the coverArt
     * @param Format\CoverArt[] $coverArt
     * @return $this
     */
    public function setCoverArt($coverArt)
    {
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
     * Set the dateCreated
     * @param \Carbon\Carbon|string $dateCreated
     * @return $this
     */
    public function setDateCreated($dateCreated)
    {
        Assert::isDate($dateCreated);

        $this->dateCreated = is_string($dateCreated)
            ? Carbon::parse($dateCreated)
            : $dateCreated;
        return $this;
    }

    /**
     * Set the dateModified
     * @param \Carbon\Carbon|string $dateModified
     * @return $this
     */
    public function setDateModified($dateModified)
    {
        Assert::isDate($dateModified);

        $this->dateModified = is_string($dateModified)
            ? Carbon::parse($dateModified)
            : $dateModified;
        return $this;
    }

    /**
     * Set the datePublished
     * @param \Carbon\Carbon|string $datePublished
     * @return $this
     */
    public function setDatePublished($datePublished)
    {
        Assert::isDate($datePublished);

        $this->datePublished = is_string($datePublished)
            ? Carbon::parse($datePublished)
            : $datePublished;
        return $this;
    }

    /**
     * Set the excerpt
     * @param string $excerpt
     * @return $this
     */
    public function setExcerpt($excerpt)
    {
        Assert::string($excerpt);

        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * Set the generatorIdentifier
     * @param string $generatorIdentifier
     * @return $this
     */
    public function setGeneratorIdentifier($generatorIdentifier)
    {
        Assert::string($generatorIdentifier);

        $this->generatorIdentifier = $generatorIdentifier;
        return $this;
    }

    /**
     * Set the generatorName
     * @param string $generatorName
     * @return $this
     */
    public function setGeneratorName($generatorName)
    {
        Assert::string($generatorName);

        $this->generatorName = $generatorName;
        return $this;
    }

    /**
     * Set the generatorVersion
     * @param string $generatorVersion
     * @return $this
     */
    public function setGeneratorVersion($generatorVersion)
    {
        Assert::string($generatorVersion);

        $this->generatorVersion = $generatorVersion;
        return $this;
    }

    /**
     * Set the keywords
     * @param string[] $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        Assert::isArray($keywords);
        Assert::allString($keywords);

        $this->keywords = $keywords;
        return $this;
    }

    /**
     * Set the links
     * @param Format\LinkedArticle[] $links
     * @return $this
     */
    public function setLinks($links)
    {
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
     * Set the thumbnailURL
     * @param string $thumbnailURL
     * @return $this
     */
    public function setThumbnailURL($thumbnailURL)
    {
        Assert::string($thumbnailURL);

        $this->thumbnailURL = $thumbnailURL;
        return $this;
    }

    /**
     * Set the transparentToolbar
     * @param boolean $transparentToolbar
     * @return $this
     */
    public function setTransparentToolbar($transparentToolbar)
    {
        Assert::boolean($transparentToolbar);

        $this->transparentToolbar = $transparentToolbar;
        return $this;
    }

    /**
     * Set the videoURL
     * @param uri $videoURL
     * @return $this
     */
    public function setVideoURL($videoURL)
    {
        Assert::uri($videoURL);

        $this->videoURL = $videoURL;
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
