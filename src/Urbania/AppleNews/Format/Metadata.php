<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Information about your article, including author name, creation date,
 * publication date, keywords, and excerpt.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/metadata.json
 */
class Metadata extends BaseSdkObject
{
    /**
     * The authors of this article. The value may or may not be the same
     * string provided in the  or  component.
     *  Note the following:
     * Note that the byline or author component in the article body does not
     * have these same requirements.
     * This value appears in the article tile in channel feeds and section
     * feeds.
     * @var string[]
     */
    protected $authors;

    /**
     * A set of key-value pairs, where the value is an array of at least one
     * item that you can leverage to target your advertising campaigns to
     * specific articles or groups of articles. See  in the .
     * @var \Urbania\AppleNews\Format\CampaignData
     */
    protected $campaignData;

    /**
     * The canonical URL of a web version of this article. If this Apple
     * News Format document corresponds to a web version of this article, set
     * this property to the URL of the web article. This property can be used
     * to point to one version of the article as well as to redirect devices
     * that do not support News content.
     * If canonicalURL is omitted, devices that do not support News cannot
     * display the article.
     * @var string
     */
    protected $canonicalURL;

    /**
     * An optional string value indicating the usage of artificial
     * intelligence (AI) tools to generate content for this article.
     * Use the AI value to indicate that the content is AI-generated.
     * @var string
     */
    protected $contentGenerationType;

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
     * This date is used instead of datePublished in the article tile if it
     * is later than datePublished by less than 48 hours. dateModified does
     * not affect the feed order.   See .
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
     * Some text representing your article. It can also be an article summary
     * or subheadline. Although this property is optional, it’s best to
     * define it in all of your Apple News Format documents. Your excerpt
     * should be within the recommended 80–300 character range.
     * This text may appear in the article tile in feeds. It can also appear
     * when an article is shared.
     * See .
     * Do not use HTML tags or Markdown syntax for this property.
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
    protected $generatorName = 'Urbania/AppleNews';

    /**
     * The version “number,” as a string, of the generator used to create
     * the JSON document.
     * @var string
     */
    protected $generatorVersion = '1.0';

    /**
     * The object for defining information about an issue.
     * @var \Urbania\AppleNews\Format\Issue
     */
    protected $issue;

    /**
     * The keywords that describe this article. You can define up to 50
     * keywords.
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
     * high-resolution image. The image is automatically scaled down to the
     * correct size.
     * Supported image types are JPEG, (.jpeg or .jpg) WebP, GIF, or PNG.
     * WebP and GIF images provided as thumbnailURL are converted to JPEG for
     * use as an article thumbnail. Note that animations are removed from
     * WebP and GIF images.
     * The minimum size of the image must be 300 px wide x 300 px high.
     * The aspect ratio (width ÷ height) must be between 0.5 and 3.0.
     * To improve the loading time of the article, use one of the images in
     * the article as the thumbnail image. If you use the same images in both
     * places and the image appears on the first screen of the article, the
     * image moves with an animated effect from the feed to the article. See
     * .
     * @var string
     */
    protected $thumbnailURL;

    /**
     * A Boolean value that indicates whether this article should be shown
     * with a transparent top toolbar that is overlaid on the top portion of
     * the article.
     * If you set this property to true, make sure to leave some room between
     * the top of the article and the first readable component, and make sure
     * the top portion of the article is predominantly dark or predominantly
     * light.
     * @var boolean
     */
    protected $transparentToolbar;

    /**
     * The URL for the video that represents this article. A glyph appears
     * on the thumbnail of the article tile, allowing the video to be
     * playable from For You, topic, and channel feeds.
     * The videoURL should be the same as the URL for one of the  components
     * in the article. For the best results or continuous playback for an
     * opened article with a videoURL, make sure that the thumbnailURL
     * property in metadata uses the same image file as the video
     * component’s stillURL.
     * Video URL must begin with http:// or preferably https://. The video
     * must be in one of the supported HTTP Live Streaming (HLS) formats.
     * Streaming using the M3U playlist format is highly recommended. See .
     * For more information about HLS, see .
     * @var string
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

        if (isset($data['contentGenerationType'])) {
            $this->setContentGenerationType($data['contentGenerationType']);
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

        if (isset($data['issue'])) {
            $this->setIssue($data['issue']);
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
     * Add an item to authors
     * @param string $item
     * @return $this
     */
    public function addAuthor($item)
    {
        return $this->setAuthors(
            !is_null($this->authors) ? array_merge($this->authors, [$item]) : [$item]
        );
    }

    /**
     * Add items to authors
     * @param array $items
     * @return $this
     */
    public function addAuthors($items)
    {
        Assert::isArray($items);
        return $this->setAuthors(
            !is_null($this->authors) ? array_merge($this->authors, $items) : $items
        );
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

        Assert::isSdkObject($campaignData, CampaignData::class);

        $this->campaignData = Utils::isAssociativeArray($campaignData)
            ? new CampaignData($campaignData)
            : $campaignData;
        return $this;
    }

    /**
     * Get the canonicalURL
     * @return string
     */
    public function getCanonicalURL()
    {
        return $this->canonicalURL;
    }

    /**
     * Set the canonicalURL
     * @param string $canonicalURL
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
     * Get the contentGenerationType
     * @return string
     */
    public function getContentGenerationType()
    {
        return $this->contentGenerationType;
    }

    /**
     * Set the contentGenerationType
     * @param string $contentGenerationType
     * @return $this
     */
    public function setContentGenerationType($contentGenerationType)
    {
        if (is_null($contentGenerationType)) {
            $this->contentGenerationType = null;
            return $this;
        }

        Assert::oneOf($contentGenerationType, ['AI']);

        $this->contentGenerationType = $contentGenerationType;
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

        $this->dateCreated = is_string($dateCreated) ? Carbon::parse($dateCreated) : $dateCreated;
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
     * Get the issue
     * @return \Urbania\AppleNews\Format\Issue
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set the issue
     * @param \Urbania\AppleNews\Format\Issue|array $issue
     * @return $this
     */
    public function setIssue($issue)
    {
        if (is_null($issue)) {
            $this->issue = null;
            return $this;
        }

        Assert::isSdkObject($issue, Issue::class);

        $this->issue = Utils::isAssociativeArray($issue) ? new Issue($issue) : $issue;
        return $this;
    }

    /**
     * Add an item to keywords
     * @param string $item
     * @return $this
     */
    public function addKeyword($item)
    {
        return $this->setKeywords(
            !is_null($this->keywords) ? array_merge($this->keywords, [$item]) : [$item]
        );
    }

    /**
     * Add items to keywords
     * @param array $items
     * @return $this
     */
    public function addKeywords($items)
    {
        Assert::isArray($items);
        return $this->setKeywords(
            !is_null($this->keywords) ? array_merge($this->keywords, $items) : $items
        );
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
     * Add an item to links
     * @param \Urbania\AppleNews\Format\LinkedArticle|array $item
     * @return $this
     */
    public function addLink($item)
    {
        return $this->setLinks(
            !is_null($this->links) ? array_merge($this->links, [$item]) : [$item]
        );
    }

    /**
     * Add items to links
     * @param array $items
     * @return $this
     */
    public function addLinks($items)
    {
        Assert::isArray($items);
        return $this->setLinks(!is_null($this->links) ? array_merge($this->links, $items) : $items);
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
        Assert::allIsSdkObject($links, LinkedArticle::class);

        $this->links = is_array($links)
            ? array_reduce(
                array_keys($links),
                function ($array, $key) use ($links) {
                    $item = $links[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new LinkedArticle($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $links;
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
     * @return string
     */
    public function getVideoURL()
    {
        return $this->videoURL;
    }

    /**
     * Set the videoURL
     * @param string $videoURL
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
            $data['campaignData'] =
                $this->campaignData instanceof Arrayable
                    ? $this->campaignData->toArray()
                    : $this->campaignData;
        }
        if (isset($this->canonicalURL)) {
            $data['canonicalURL'] = $this->canonicalURL;
        }
        if (isset($this->contentGenerationType)) {
            $data['contentGenerationType'] = $this->contentGenerationType;
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
        if (isset($this->issue)) {
            $data['issue'] =
                $this->issue instanceof Arrayable ? $this->issue->toArray() : $this->issue;
        }
        if (isset($this->keywords)) {
            $data['keywords'] = $this->keywords;
        }
        if (isset($this->links)) {
            $data['links'] = !is_null($this->links)
                ? array_reduce(
                    array_keys($this->links),
                    function ($items, $key) {
                        $items[$key] =
                            $this->links[$key] instanceof Arrayable
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
