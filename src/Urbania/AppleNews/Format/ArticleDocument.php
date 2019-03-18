<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The root object of an Apple News article, containing required
 * properties, metadata, content, layout, and styles.
 *
 * @see https://developer.apple.com/documentation/apple_news/articledocument
 */
class ArticleDocument implements \JsonSerializable
{
    /**
     * The version of Apple News Format used in the JSON document. The
     * documentation notes the version of each property.
     * @var string
     */
    protected $version;

    /**
     * An unique, publisher-provided identifier for this article. This
     * identifier must remain constant; it cannot change when the article is
     * updated.
     * @var string
     */
    protected $identifier;

    /**
     * The article title or headline. Should be plain text; formatted text
     * (HTML or Markdown) is not supported.
     * @var string
     */
    protected $title;

    /**
     * A code that indicates the language of the article. Use the IANA.org
     * language subtag registry to find the appropriate code; e.g., en for
     * English, or the more specific en_UK for English (U.K.) or en_US for
     * English (U.S.).
     * @var string
     */
    protected $language;

    /**
     * The article’s column system. Apple News Format layouts make it
     * possible to recreate print design on iPhone, iPad, iPod touch and Mac.
     * Layout information is also used to calculate relative positioning and
     * size for these devices. See Planning the Layout for Your Article.
     * @var \Urbania\AppleNews\Format\Layout
     */
    protected $layout;

    /**
     * An array of components that form the content of this article.
     * Components have different roles and types, such as Photo and Music.
     * @var Format\Component[]
     */
    protected $components;

    /**
     * The component text styles that can be referred to by components in
     * this document. Each article.json file must have, at minimum, a default
     * component text style named default. Defaults by component role can
     * also be set. See Defining and Using Text Styles.
     * @var \Urbania\AppleNews\Format\ComponentTextStyles
     */
    protected $componentTextStyles;

    /**
     * Allows an advertisement to be inserted at a position that is both
     * possible and optimal. You can specify what bannerType you want to have
     * automatically inserted.
     * @var \Urbania\AppleNews\Format\AdvertisingSettings
     */
    protected $advertisingSettings;

    /**
     * The article subtitle. Should be plain text; formatted text (HTML or
     * Markdown) is not supported.
     * @var string
     */
    protected $subtitle;

    /**
     * Article metadata, such as publication date, ad campaign data, and
     * other information that is not part of the core article content.
     * @var \Urbania\AppleNews\Format\Metadata
     */
    protected $metadata;

    /**
     * An object containing the background color of the article.
     * @var \Urbania\AppleNews\Format\DocumentStyle
     */
    protected $documentStyle;

    /**
     * The TextStyle objects available to use inline for text in Text
     * components. See Using HTML with Apple News Format, Using Markdown with
     * Apple News Format, and InlineTextStyle.
     * @var \Urbania\AppleNews\Format\TextStyles
     */
    protected $textStyles;

    /**
     * Article-level ComponentLayout objects that can be referred to by their
     * key within the ComponentLayouts object. See Positioning the Content in
     * Your Article.
     * @var \Urbania\AppleNews\Format\ComponentLayouts
     */
    protected $componentLayouts;

    /**
     * The component styles that can be referred to by components within this
     * document. See Understanding Styles.
     * @var \Urbania\AppleNews\Format\ComponentStyles
     */
    protected $componentStyles;

    public function __construct(array $data = [])
    {
        if (isset($data['version'])) {
            $this->setVersion($data['version']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['title'])) {
            $this->setTitle($data['title']);
        }

        if (isset($data['language'])) {
            $this->setLanguage($data['language']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['components'])) {
            $this->setComponents($data['components']);
        }

        if (isset($data['componentTextStyles'])) {
            $this->setComponentTextStyles($data['componentTextStyles']);
        }

        if (isset($data['advertisingSettings'])) {
            $this->setAdvertisingSettings($data['advertisingSettings']);
        }

        if (isset($data['subtitle'])) {
            $this->setSubtitle($data['subtitle']);
        }

        if (isset($data['metadata'])) {
            $this->setMetadata($data['metadata']);
        }

        if (isset($data['documentStyle'])) {
            $this->setDocumentStyle($data['documentStyle']);
        }

        if (isset($data['textStyles'])) {
            $this->setTextStyles($data['textStyles']);
        }

        if (isset($data['componentLayouts'])) {
            $this->setComponentLayouts($data['componentLayouts']);
        }

        if (isset($data['componentStyles'])) {
            $this->setComponentStyles($data['componentStyles']);
        }
    }

    /**
     * Get the advertisingSettings
     * @return \Urbania\AppleNews\Format\AdvertisingSettings
     */
    public function getAdvertisingSettings()
    {
        return $this->advertisingSettings;
    }

    /**
     * Set the advertisingSettings
     * @param \Urbania\AppleNews\Format\AdvertisingSettings|array $advertisingSettings
     * @return $this
     */
    public function setAdvertisingSettings($advertisingSettings)
    {
        if (is_object($advertisingSettings)) {
            Assert::isInstanceOf(
                $advertisingSettings,
                AdvertisingSettings::class
            );
        } else {
            Assert::isArray($advertisingSettings);
        }

        $this->advertisingSettings = is_array($advertisingSettings)
            ? new AdvertisingSettings($advertisingSettings)
            : $advertisingSettings;
        return $this;
    }

    /**
     * Get the componentLayouts
     * @return \Urbania\AppleNews\Format\ComponentLayouts
     */
    public function getComponentLayouts()
    {
        return $this->componentLayouts;
    }

    /**
     * Set the componentLayouts
     * @param \Urbania\AppleNews\Format\ComponentLayouts|array $componentLayouts
     * @return $this
     */
    public function setComponentLayouts($componentLayouts)
    {
        if (is_object($componentLayouts)) {
            Assert::isInstanceOf($componentLayouts, ComponentLayouts::class);
        } else {
            Assert::isArray($componentLayouts);
        }

        $this->componentLayouts = is_array($componentLayouts)
            ? new ComponentLayouts($componentLayouts)
            : $componentLayouts;
        return $this;
    }

    /**
     * Get the componentStyles
     * @return \Urbania\AppleNews\Format\ComponentStyles
     */
    public function getComponentStyles()
    {
        return $this->componentStyles;
    }

    /**
     * Set the componentStyles
     * @param \Urbania\AppleNews\Format\ComponentStyles|array $componentStyles
     * @return $this
     */
    public function setComponentStyles($componentStyles)
    {
        if (is_object($componentStyles)) {
            Assert::isInstanceOf($componentStyles, ComponentStyles::class);
        } else {
            Assert::isArray($componentStyles);
        }

        $this->componentStyles = is_array($componentStyles)
            ? new ComponentStyles($componentStyles)
            : $componentStyles;
        return $this;
    }

    /**
     * Get the componentTextStyles
     * @return \Urbania\AppleNews\Format\ComponentTextStyles
     */
    public function getComponentTextStyles()
    {
        return $this->componentTextStyles;
    }

    /**
     * Set the componentTextStyles
     * @param \Urbania\AppleNews\Format\ComponentTextStyles|array $componentTextStyles
     * @return $this
     */
    public function setComponentTextStyles($componentTextStyles)
    {
        if (is_object($componentTextStyles)) {
            Assert::isInstanceOf(
                $componentTextStyles,
                ComponentTextStyles::class
            );
        } else {
            Assert::isArray($componentTextStyles);
        }

        $this->componentTextStyles = is_array($componentTextStyles)
            ? new ComponentTextStyles($componentTextStyles)
            : $componentTextStyles;
        return $this;
    }

    /**
     * Get the components
     * @return Format\Component[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * Set the components
     * @param Format\Component[] $components
     * @return $this
     */
    public function setComponents($components)
    {
        Assert::isArray($components);
        Assert::allIsInstanceOfOrArray($components, Component::class);

        $items = [];
        foreach ($components as $key => $item) {
            $items[$key] = is_array($item)
                ? Component::createTyped($item)
                : $item;
        }
        $this->components = $items;
        return $this;
    }

    /**
     * Get the documentStyle
     * @return \Urbania\AppleNews\Format\DocumentStyle
     */
    public function getDocumentStyle()
    {
        return $this->documentStyle;
    }

    /**
     * Set the documentStyle
     * @param \Urbania\AppleNews\Format\DocumentStyle|array $documentStyle
     * @return $this
     */
    public function setDocumentStyle($documentStyle)
    {
        if (is_object($documentStyle)) {
            Assert::isInstanceOf($documentStyle, DocumentStyle::class);
        } else {
            Assert::isArray($documentStyle);
        }

        $this->documentStyle = is_array($documentStyle)
            ? new DocumentStyle($documentStyle)
            : $documentStyle;
        return $this;
    }

    /**
     * Get the identifier
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the identifier
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        Assert::string($identifier);

        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get the language
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the language
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        Assert::string($language);

        $this->language = $language;
        return $this;
    }

    /**
     * Get the layout
     * @return \Urbania\AppleNews\Format\Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\Layout|array $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_object($layout)) {
            Assert::isInstanceOf($layout, Layout::class);
        } else {
            Assert::isArray($layout);
        }

        $this->layout = is_array($layout) ? new Layout($layout) : $layout;
        return $this;
    }

    /**
     * Get the metadata
     * @return \Urbania\AppleNews\Format\Metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Set the metadata
     * @param \Urbania\AppleNews\Format\Metadata|array $metadata
     * @return $this
     */
    public function setMetadata($metadata)
    {
        if (is_object($metadata)) {
            Assert::isInstanceOf($metadata, Metadata::class);
        } else {
            Assert::isArray($metadata);
        }

        $this->metadata = is_array($metadata)
            ? new Metadata($metadata)
            : $metadata;
        return $this;
    }

    /**
     * Get the subtitle
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the subtitle
     * @param string $subtitle
     * @return $this
     */
    public function setSubtitle($subtitle)
    {
        Assert::string($subtitle);

        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * Get the textStyles
     * @return \Urbania\AppleNews\Format\TextStyles
     */
    public function getTextStyles()
    {
        return $this->textStyles;
    }

    /**
     * Set the textStyles
     * @param \Urbania\AppleNews\Format\TextStyles|array $textStyles
     * @return $this
     */
    public function setTextStyles($textStyles)
    {
        if (is_object($textStyles)) {
            Assert::isInstanceOf($textStyles, TextStyles::class);
        } else {
            Assert::isArray($textStyles);
        }

        $this->textStyles = is_array($textStyles)
            ? new TextStyles($textStyles)
            : $textStyles;
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
        Assert::string($title);

        $this->title = $title;
        return $this;
    }

    /**
     * Get the version
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        Assert::string($version);

        $this->version = $version;
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
        if (isset($this->version)) {
            $data['version'] = $this->version;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->title)) {
            $data['title'] = $this->title;
        }
        if (isset($this->language)) {
            $data['language'] = $this->language;
        }
        if (isset($this->layout)) {
            $data['layout'] = is_object($this->layout)
                ? $this->layout->toArray()
                : $this->layout;
        }
        if (isset($this->components)) {
            $data['components'] = !is_null($this->components)
                ? array_reduce(
                    array_keys($this->components),
                    function ($items, $key) {
                        $items[$key] = is_object($this->components[$key])
                            ? $this->components[$key]->toArray()
                            : $this->components[$key];
                        return $items;
                    },
                    []
                )
                : $this->components;
        }
        if (isset($this->componentTextStyles)) {
            $data['componentTextStyles'] = is_object($this->componentTextStyles)
                ? $this->componentTextStyles->toArray()
                : $this->componentTextStyles;
        }
        if (isset($this->advertisingSettings)) {
            $data['advertisingSettings'] = is_object($this->advertisingSettings)
                ? $this->advertisingSettings->toArray()
                : $this->advertisingSettings;
        }
        if (isset($this->subtitle)) {
            $data['subtitle'] = $this->subtitle;
        }
        if (isset($this->metadata)) {
            $data['metadata'] = is_object($this->metadata)
                ? $this->metadata->toArray()
                : $this->metadata;
        }
        if (isset($this->documentStyle)) {
            $data['documentStyle'] = is_object($this->documentStyle)
                ? $this->documentStyle->toArray()
                : $this->documentStyle;
        }
        if (isset($this->textStyles)) {
            $data['textStyles'] = is_object($this->textStyles)
                ? $this->textStyles->toArray()
                : $this->textStyles;
        }
        if (isset($this->componentLayouts)) {
            $data['componentLayouts'] = is_object($this->componentLayouts)
                ? $this->componentLayouts->toArray()
                : $this->componentLayouts;
        }
        if (isset($this->componentStyles)) {
            $data['componentStyles'] = is_object($this->componentStyles)
                ? $this->componentStyles->toArray()
                : $this->componentStyles;
        }
        return $data;
    }
}
