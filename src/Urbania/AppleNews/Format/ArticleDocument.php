<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Concerns\FindsComponents;
use Urbania\AppleNews\Support\Utils;

/**
 * The root object of an Apple News article, that contains required
 * properties, metadata, content, layout, and styles.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articledocument.json
 */
class ArticleDocument extends BaseSdkObject
{
    use FindsComponents;

    /**
     * An array of components that form the content of this article.
     * Components have different roles and types, such as  and .
     * @var Format\Component[]
     */
    protected $components;

    /**
     * The component text styles that can be referred to by components in
     * this document. Each article.json file must have, at minimum, a default
     * component text style named default. Defaults by component role can
     * also be set. See .
     * @var \Urbania\AppleNews\Format\ComponentTextStyles
     */
    protected $componentTextStyles;

    /**
     * A unique, publisher-provided identifier for this article. This
     * identifier must remain constant; it cannot change when the article is
     * updated. See .
     * This identifier can include the following:
     * @var string
     */
    protected $identifier;

    /**
     * A code that indicates the language of the article. Use the  to find
     * the appropriate code; e.g., en for English, or the more specific en-GB
     * for English (U.K.) or en-US for English (U.S.).
     * @var string
     */
    protected $language;

    /**
     * The article’s column system. Apple News Format layouts make it
     * possible to recreate print design on iPhone, iPad, iPod touch and Mac.
     * Layout information is also used to calculate relative positioning and
     * size for these devices. See .
     * @var \Urbania\AppleNews\Format\Layout
     */
    protected $layout;

    /**
     * The article title or headline. Should be plain text; formatted text
     * (HTML or Markdown) is not supported.
     * @var string
     */
    protected $title;

    /**
     * The version of Apple News Format used in the JSON document.
     * The value of the version property must not be earlier than the version
     * number of any property that is used anywhere in the article.
     * See .
     * @var string
     */
    protected $version;

    /**
     * An advertisement to be inserted at a position that is both possible
     * and optimal. You can specify what bannerType you want to have
     * automatically inserted.
     * Note. This property is deprecated. Use the  object instead.
     * @var \Urbania\AppleNews\Format\AdvertisingSettings
     */
    protected $advertisingSettings;

    /**
     * The metadata, appearance, and placement of advertising and related
     * content components within Apple News Format articles.
     * @var \Urbania\AppleNews\Format\AutoPlacement
     */
    protected $autoplacement;

    /**
     * The colorScheme object that you use for automatic Dark Mode behavior.
     * @var \Urbania\AppleNews\Format\ColorScheme
     */
    protected $colorScheme;

    /**
     * The article-level ComponentLayout objects that can be referred to by
     * their key within the ComponentLayouts object. See .
     * @var \Urbania\AppleNews\Format\ComponentLayouts
     */
    protected $componentLayouts;

    /**
     * The component styles that can be referred to by components within this
     * document. See .
     * @var \Urbania\AppleNews\Format\ComponentStyles
     */
    protected $componentStyles;

    /**
     * An object containing the background color of the article.
     * @var \Urbania\AppleNews\Format\DocumentStyle
     */
    protected $documentStyle;

    /**
     * The article's metadata, such as publication date, ad campaign data,
     * and other information that is not part of the core article content.
     * @var \Urbania\AppleNews\Format\Metadata
     */
    protected $metadata;

    /**
     * The article subtitle. Should be plain text; formatted text (HTML or
     * Markdown) is not supported.
     * @var string
     */
    protected $subtitle;

    /**
     * The global text format to apply to  components and  objects.
     * If the textFormat property is not specified, the format of Text
     * components and formattedText objects defaults to none.
     * If the textFormat property is specified, the format of Text components
     * and formattedText objects defaults to the value of this property.
     * To override the textFormat value, use the format property in the Text
     * component or the formattedText object.
     * @var string
     */
    protected $textFormat;

    /**
     * The TextStyle objects available to use inline for text in Text
     * components. See , , and .
     * @var \Urbania\AppleNews\Format\TextStyles
     */
    protected $textStyles;

    public function __construct(array $data = [])
    {
        if (isset($data['components'])) {
            $this->setComponents($data['components']);
        }

        if (isset($data['componentTextStyles'])) {
            $this->setComponentTextStyles($data['componentTextStyles']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['language'])) {
            $this->setLanguage($data['language']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['title'])) {
            $this->setTitle($data['title']);
        }

        if (isset($data['version'])) {
            $this->setVersion($data['version']);
        }

        if (isset($data['advertisingSettings'])) {
            $this->setAdvertisingSettings($data['advertisingSettings']);
        }

        if (isset($data['autoplacement'])) {
            $this->setAutoplacement($data['autoplacement']);
        }

        if (isset($data['colorScheme'])) {
            $this->setColorScheme($data['colorScheme']);
        }

        if (isset($data['componentLayouts'])) {
            $this->setComponentLayouts($data['componentLayouts']);
        }

        if (isset($data['componentStyles'])) {
            $this->setComponentStyles($data['componentStyles']);
        }

        if (isset($data['documentStyle'])) {
            $this->setDocumentStyle($data['documentStyle']);
        }

        if (isset($data['metadata'])) {
            $this->setMetadata($data['metadata']);
        }

        if (isset($data['subtitle'])) {
            $this->setSubtitle($data['subtitle']);
        }

        if (isset($data['textFormat'])) {
            $this->setTextFormat($data['textFormat']);
        }

        if (isset($data['textStyles'])) {
            $this->setTextStyles($data['textStyles']);
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
        if (is_null($advertisingSettings)) {
            $this->advertisingSettings = null;
            return $this;
        }

        Assert::isSdkObject($advertisingSettings, AdvertisingSettings::class);

        $this->advertisingSettings = Utils::isAssociativeArray($advertisingSettings)
            ? new AdvertisingSettings($advertisingSettings)
            : $advertisingSettings;
        return $this;
    }

    /**
     * Get the autoplacement
     * @return \Urbania\AppleNews\Format\AutoPlacement
     */
    public function getAutoplacement()
    {
        return $this->autoplacement;
    }

    /**
     * Set the autoplacement
     * @param \Urbania\AppleNews\Format\AutoPlacement|array $autoplacement
     * @return $this
     */
    public function setAutoplacement($autoplacement)
    {
        if (is_null($autoplacement)) {
            $this->autoplacement = null;
            return $this;
        }

        Assert::isSdkObject($autoplacement, AutoPlacement::class);

        $this->autoplacement = Utils::isAssociativeArray($autoplacement)
            ? new AutoPlacement($autoplacement)
            : $autoplacement;
        return $this;
    }

    /**
     * Get the colorScheme
     * @return \Urbania\AppleNews\Format\ColorScheme
     */
    public function getColorScheme()
    {
        return $this->colorScheme;
    }

    /**
     * Set the colorScheme
     * @param \Urbania\AppleNews\Format\ColorScheme|array $colorScheme
     * @return $this
     */
    public function setColorScheme($colorScheme)
    {
        if (is_null($colorScheme)) {
            $this->colorScheme = null;
            return $this;
        }

        Assert::isSdkObject($colorScheme, ColorScheme::class);

        $this->colorScheme = Utils::isAssociativeArray($colorScheme)
            ? new ColorScheme($colorScheme)
            : $colorScheme;
        return $this;
    }

    /**
     * Add an item to components
     * @param \Urbania\AppleNews\Format\Component|array $item
     * @return $this
     */
    public function addComponent($item)
    {
        return $this->setComponents(
            !is_null($this->components) ? array_merge($this->components, [$item]) : [$item]
        );
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
        if (is_null($componentLayouts)) {
            $this->componentLayouts = null;
            return $this;
        }

        Assert::isSdkObject($componentLayouts, ComponentLayouts::class);

        $this->componentLayouts = Utils::isAssociativeArray($componentLayouts)
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
        if (is_null($componentStyles)) {
            $this->componentStyles = null;
            return $this;
        }

        Assert::isSdkObject($componentStyles, ComponentStyles::class);

        $this->componentStyles = Utils::isAssociativeArray($componentStyles)
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
        Assert::isSdkObject($componentTextStyles, ComponentTextStyles::class);

        $this->componentTextStyles = Utils::isAssociativeArray($componentTextStyles)
            ? new ComponentTextStyles($componentTextStyles)
            : $componentTextStyles;
        return $this;
    }

    /**
     * Add items to components
     * @param array $items
     * @return $this
     */
    public function addComponents($items)
    {
        Assert::isArray($items);
        return $this->setComponents(
            !is_null($this->components) ? array_merge($this->components, $items) : $items
        );
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
        Assert::allIsComponent($components);

        $this->components = is_array($components)
            ? array_reduce(
                array_keys($components),
                function ($array, $key) use ($components) {
                    $item = $components[$key];
                    if ($item instanceof Componentable) {
                        $array[$key] = $item->toComponent();
                    } elseif (Utils::isAssociativeArray($item)) {
                        $array[$key] = Component::createTyped($item);
                    } else {
                        $array[$key] = $item;
                    }
                    return $array;
                },
                []
            )
            : $components;
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
        if (is_null($documentStyle)) {
            $this->documentStyle = null;
            return $this;
        }

        Assert::isSdkObject($documentStyle, DocumentStyle::class);

        $this->documentStyle = Utils::isAssociativeArray($documentStyle)
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
        Assert::isSdkObject($layout, Layout::class);

        $this->layout = Utils::isAssociativeArray($layout) ? new Layout($layout) : $layout;
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
        if (is_null($metadata)) {
            $this->metadata = null;
            return $this;
        }

        Assert::isSdkObject($metadata, Metadata::class);

        $this->metadata = Utils::isAssociativeArray($metadata)
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
        if (is_null($subtitle)) {
            $this->subtitle = null;
            return $this;
        }

        Assert::string($subtitle);

        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * Get the textFormat
     * @return string
     */
    public function getTextFormat()
    {
        return $this->textFormat;
    }

    /**
     * Set the textFormat
     * @param string $textFormat
     * @return $this
     */
    public function setTextFormat($textFormat)
    {
        if (is_null($textFormat)) {
            $this->textFormat = null;
            return $this;
        }

        Assert::oneOf($textFormat, ['markdown', 'html', 'none']);

        $this->textFormat = $textFormat;
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
        if (is_null($textStyles)) {
            $this->textStyles = null;
            return $this;
        }

        Assert::isSdkObject($textStyles, TextStyles::class);

        $this->textStyles = Utils::isAssociativeArray($textStyles)
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->components)) {
            $data['components'] = !is_null($this->components)
                ? array_reduce(
                    array_keys($this->components),
                    function ($items, $key) {
                        $items[$key] =
                            $this->components[$key] instanceof Arrayable
                                ? $this->components[$key]->toArray()
                                : $this->components[$key];
                        return $items;
                    },
                    []
                )
                : $this->components;
        }
        if (isset($this->componentTextStyles)) {
            $data['componentTextStyles'] =
                $this->componentTextStyles instanceof Arrayable
                    ? $this->componentTextStyles->toArray()
                    : $this->componentTextStyles;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->language)) {
            $data['language'] = $this->language;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        if (isset($this->title)) {
            $data['title'] = $this->title;
        }
        if (isset($this->version)) {
            $data['version'] = $this->version;
        }
        if (isset($this->advertisingSettings)) {
            $data['advertisingSettings'] =
                $this->advertisingSettings instanceof Arrayable
                    ? $this->advertisingSettings->toArray()
                    : $this->advertisingSettings;
        }
        if (isset($this->autoplacement)) {
            $data['autoplacement'] =
                $this->autoplacement instanceof Arrayable
                    ? $this->autoplacement->toArray()
                    : $this->autoplacement;
        }
        if (isset($this->colorScheme)) {
            $data['colorScheme'] =
                $this->colorScheme instanceof Arrayable
                    ? $this->colorScheme->toArray()
                    : $this->colorScheme;
        }
        if (isset($this->componentLayouts)) {
            $data['componentLayouts'] =
                $this->componentLayouts instanceof Arrayable
                    ? $this->componentLayouts->toArray()
                    : $this->componentLayouts;
        }
        if (isset($this->componentStyles)) {
            $data['componentStyles'] =
                $this->componentStyles instanceof Arrayable
                    ? $this->componentStyles->toArray()
                    : $this->componentStyles;
        }
        if (isset($this->documentStyle)) {
            $data['documentStyle'] =
                $this->documentStyle instanceof Arrayable
                    ? $this->documentStyle->toArray()
                    : $this->documentStyle;
        }
        if (isset($this->metadata)) {
            $data['metadata'] =
                $this->metadata instanceof Arrayable ? $this->metadata->toArray() : $this->metadata;
        }
        if (isset($this->subtitle)) {
            $data['subtitle'] = $this->subtitle;
        }
        if (isset($this->textFormat)) {
            $data['textFormat'] = $this->textFormat;
        }
        if (isset($this->textStyles)) {
            $data['textStyles'] =
                $this->textStyles instanceof Arrayable
                    ? $this->textStyles->toArray()
                    : $this->textStyles;
        }
        return $data;
    }
}
