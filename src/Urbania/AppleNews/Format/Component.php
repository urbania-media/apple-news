<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all component types.
 *
 * @see https://developer.apple.com/documentation/apple_news/component
 */
class Component implements \JsonSerializable
{
    protected static $typeProperty = 'role';

    protected static $types = [
        'audio' => 'Audio',
        'music' => 'Music',
        'author' => 'Author',
        'illustrator' => 'Illustrator',
        'photographer' => 'Photographer',
        'embedwebvideo' => 'EmbedWebVideo',
        'aside' => 'Aside',
        'header' => 'Header',
        'section' => 'Section',
        'chapter' => 'Chapter',
        'container' => 'Container',
        'body' => 'Body',
        'title' => 'Title',
        'intro' => 'Intro',
        'caption' => 'Caption',
        'photo' => 'Photo',
        'figure' => 'Figure',
        'portrait' => 'Portrait',
        'logo' => 'Logo',
        'gallery' => 'Gallery',
        'mosaic' => 'Mosaic',
        'quote' => 'Quote',
        'pullquote' => 'PullQuote',
        'datatable' => 'DataTable',
        'map' => 'Map',
        'place' => 'Place',
        'instagram' => 'Instagram',
        'facebook_post' => 'FacebookPost',
        'tweet' => 'Tweet',
        'htmltable' => 'HTMLTable',
        'banner_advertisement' => 'BannerAdvertisement',
        'medium_rectangle_advertisement' => 'MediumRectangleAdvertisement'
    ];

    /**
     * An Anchor object that aligns this component vertically with another
     * component.
     * @var \Urbania\AppleNews\Format\Anchor
     */
    protected $anchor;

    /**
     * An object that applies an animation effect, such as a FadeInAnimation,
     * to this component.
     * @var \Urbania\AppleNews\Format\ComponentAnimation
     */
    protected $animation;

    /**
     * A behavior object that applies a motion effect or other physics
     * effect, such as Parallax or Springy.
     * @var \Urbania\AppleNews\Format\Behavior
     */
    protected $behavior;

    /**
     * A unique identifier for this component. If used, identifier must be
     * unique across the entire document. An identifier is required if you
     * want to anchor other components to this component. See Anchor.
     * @var string
     */
    protected $identifier;

    /**
     * Either an inline ComponentLayout object that contains layout
     * information, or a string reference to a component layout that is
     * defined in Article Document.Component Layouts.
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * The role of a component (for example, title, body, or pullquote)
     * conveys the semantic value of the content or its function within the
     * article.
     * @var string
     */
    protected $role;

    /**
     * Either an inline ComponentStyle object that defines the appearance of
     * this component, or a string reference to a component style that is
     * defined in in Article Document.Component Styles.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string
     */
    protected $style;

    public function __construct(array $data = [])
    {
        if (isset($data['anchor'])) {
            $this->setAnchor($data['anchor']);
        }

        if (isset($data['animation'])) {
            $this->setAnimation($data['animation']);
        }

        if (isset($data['behavior'])) {
            $this->setBehavior($data['behavior']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['role'])) {
            $this->setRole($data['role']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }
    }

    public static function createTyped(array $data)
    {
        if (isset($data[static::$typeProperty])) {
            $typeName = $data[static::$typeProperty];
            $type = static::$types[$typeName] ?? null;
            if (!is_null($type)) {
                $namespace = implode(
                    '\\',
                    array_slice(explode('\\', static::class), 0, -1)
                );
                $typeClass = $namespace . '\\' . $type;
                return new $typeClass($data);
            }
        }

        return new static($data);
    }

    /**
     * Get the anchor
     * @return \Urbania\AppleNews\Format\Anchor
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Set the anchor
     * @param \Urbania\AppleNews\Format\Anchor|array $anchor
     * @return $this
     */
    public function setAnchor($anchor)
    {
        if (is_object($anchor)) {
            Assert::isInstanceOf($anchor, Anchor::class);
        } else {
            Assert::isArray($anchor);
        }

        $this->anchor = is_array($anchor) ? new Anchor($anchor) : $anchor;
        return $this;
    }

    /**
     * Get the animation
     * @return \Urbania\AppleNews\Format\ComponentAnimation
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set the animation
     * @param \Urbania\AppleNews\Format\ComponentAnimation|array $animation
     * @return $this
     */
    public function setAnimation($animation)
    {
        if (is_object($animation)) {
            Assert::isInstanceOf($animation, ComponentAnimation::class);
        } else {
            Assert::isArray($animation);
        }

        $this->animation = is_array($animation)
            ? ComponentAnimation::createTyped($animation)
            : $animation;
        return $this;
    }

    /**
     * Get the behavior
     * @return \Urbania\AppleNews\Format\Behavior
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set the behavior
     * @param \Urbania\AppleNews\Format\Behavior|array $behavior
     * @return $this
     */
    public function setBehavior($behavior)
    {
        if (is_object($behavior)) {
            Assert::isInstanceOf($behavior, Behavior::class);
        } else {
            Assert::isArray($behavior);
        }

        $this->behavior = is_array($behavior)
            ? Behavior::createTyped($behavior)
            : $behavior;
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
     * Get the layout
     * @return \Urbania\AppleNews\Format\ComponentLayout|string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\ComponentLayout|array|string $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_object($layout)) {
            Assert::isInstanceOf($layout, ComponentLayout::class);
        } elseif (!is_array($layout)) {
            Assert::string($layout);
        }

        $this->layout = is_array($layout)
            ? new ComponentLayout($layout)
            : $layout;
        return $this;
    }

    /**
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        Assert::string($role);

        $this->role = $role;
        return $this;
    }

    /**
     * Get the style
     * @return \Urbania\AppleNews\Format\ComponentStyle|string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the style
     * @param \Urbania\AppleNews\Format\ComponentStyle|array|string $style
     * @return $this
     */
    public function setStyle($style)
    {
        if (is_object($style)) {
            Assert::isInstanceOf($style, ComponentStyle::class);
        } elseif (!is_array($style)) {
            Assert::string($style);
        }

        $this->style = is_array($style) ? new ComponentStyle($style) : $style;
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
        if (isset($this->anchor)) {
            $data['anchor'] = is_object($this->anchor)
                ? $this->anchor->toArray()
                : $this->anchor;
        }
        if (isset($this->animation)) {
            $data['animation'] = is_object($this->animation)
                ? $this->animation->toArray()
                : $this->animation;
        }
        if (isset($this->behavior)) {
            $data['behavior'] = is_object($this->behavior)
                ? $this->behavior->toArray()
                : $this->behavior;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->layout)) {
            $data['layout'] = is_object($this->layout)
                ? $this->layout->toArray()
                : $this->layout;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->style)) {
            $data['style'] = is_object($this->style)
                ? $this->style->toArray()
                : $this->style;
        }
        return $data;
    }
}
