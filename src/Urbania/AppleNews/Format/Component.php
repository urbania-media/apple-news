<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all component types.
 *
 * @see https://developer.apple.com/documentation/apple_news/component
 */
class Component
{
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

    /**
     * Get the anchor
     * @return \Urbania\AppleNews\Format\Anchor
     */
    public function getAnchor()
    {
        return $this->anchor;
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
     * Get the behavior
     * @return \Urbania\AppleNews\Format\Behavior
     */
    public function getBehavior()
    {
        return $this->behavior;
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
     * Get the layout
     * @return \Urbania\AppleNews\Format\ComponentLayout|string
     */
    public function getLayout()
    {
        return $this->layout;
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
     * Get the style
     * @return \Urbania\AppleNews\Format\ComponentStyle|string
     */
    public function getStyle()
    {
        return $this->style;
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
            ? new ComponentAnimation($animation)
            : $animation;
        return $this;
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
            ? new Behavior($behavior)
            : $behavior;
        return $this;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'anchor' => is_object($this->anchor)
                ? $this->anchor->toArray()
                : $this->anchor,
            'animation' => is_object($this->animation)
                ? $this->animation->toArray()
                : $this->animation,
            'behavior' => is_object($this->behavior)
                ? $this->behavior->toArray()
                : $this->behavior,
            'identifier' => $this->identifier,
            'layout' => is_object($this->layout)
                ? $this->layout->toArray()
                : $this->layout,
            'role' => $this->role,
            'style' => is_object($this->style)
                ? $this->style->toArray()
                : $this->style
        ];
    }
}
