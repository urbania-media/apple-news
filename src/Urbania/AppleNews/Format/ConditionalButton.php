<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining a button component's conditional properties,
 * and when the conditional properties are in effect.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/conditionalbutton.json
 */
class ConditionalButton extends ConditionalComponent
{
    /**
     * An instance or array of conditions that, when met, cause the
     * conditional component properties to take effect.
     * @var Format\Condition[]|\Urbania\AppleNews\Format\Condition
     */
    protected $conditions;

    /**
     * An object that defines vertical alignment with another component.
     * @var \Urbania\AppleNews\Format\Anchor
     */
    protected $anchor;

    /**
     * An object that defines an animation to be applied to the component.
     * To remove a previously set condition, use none.
     * @var \Urbania\AppleNews\Format\ComponentAnimation|none
     */
    protected $animation;

    /**
     * An object that defines behavior for a component, like  or .
     * @var \Urbania\AppleNews\Format\Behavior|none
     */
    protected $behavior;

    /**
     * A Boolean value that determines whether the component is hidden.
     * @var boolean
     */
    protected $hidden;

    /**
     * An inline ComponentLayout object that contains layout information, or
     * a string reference to a ComponentLayout object that is defined at the
     * top level of the document.
     * If layout is not defined, size and position are based on various
     * factors, such as the device type, the length of the content, and the
     * role of this component.
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * An inline ComponentStyle object that defines the appearance of this
     * component, or a string reference to a ComponentStyle object that is
     * defined at the top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    protected $style;

    /**
     * An inline ComponentTextStyle object that contains styling information,
     * or a string reference to a ComponentTextStyle object that is defined
     * at the top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['conditions'])) {
            $this->setConditions($data['conditions']);
        }

        if (isset($data['anchor'])) {
            $this->setAnchor($data['anchor']);
        }

        if (isset($data['animation'])) {
            $this->setAnimation($data['animation']);
        }

        if (isset($data['behavior'])) {
            $this->setBehavior($data['behavior']);
        }

        if (isset($data['hidden'])) {
            $this->setHidden($data['hidden']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }

        if (isset($data['textStyle'])) {
            $this->setTextStyle($data['textStyle']);
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
     * Set the anchor
     * @param \Urbania\AppleNews\Format\Anchor|array $anchor
     * @return $this
     */
    public function setAnchor($anchor)
    {
        if (is_null($anchor)) {
            $this->anchor = null;
            return $this;
        }

        Assert::isSdkObject($anchor, Anchor::class);

        $this->anchor = Utils::isAssociativeArray($anchor) ? new Anchor($anchor) : $anchor;
        return $this;
    }

    /**
     * Get the animation
     * @return \Urbania\AppleNews\Format\ComponentAnimation|none
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set the animation
     * @param \Urbania\AppleNews\Format\ComponentAnimation|array|none $animation
     * @return $this
     */
    public function setAnimation($animation)
    {
        if (is_null($animation)) {
            $this->animation = null;
            return $this;
        }

        if (is_object($animation) || Utils::isAssociativeArray($animation)) {
            Assert::isSdkObject($animation, ComponentAnimation::class);
        } else {
            Assert::eq($animation, 'none');
        }

        $this->animation = Utils::isAssociativeArray($animation)
            ? ComponentAnimation::createTyped($animation)
            : $animation;
        return $this;
    }

    /**
     * Get the behavior
     * @return \Urbania\AppleNews\Format\Behavior|none
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set the behavior
     * @param \Urbania\AppleNews\Format\Behavior|array|none $behavior
     * @return $this
     */
    public function setBehavior($behavior)
    {
        if (is_null($behavior)) {
            $this->behavior = null;
            return $this;
        }

        if (is_object($behavior) || Utils::isAssociativeArray($behavior)) {
            Assert::isSdkObject($behavior, Behavior::class);
        } else {
            Assert::eq($behavior, 'none');
        }

        $this->behavior = Utils::isAssociativeArray($behavior)
            ? Behavior::createTyped($behavior)
            : $behavior;
        return $this;
    }

    /**
     * Get the conditions
     * @return Format\Condition[]|\Urbania\AppleNews\Format\Condition
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the conditions
     * @param Format\Condition[]|\Urbania\AppleNews\Format\Condition|array $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        if (is_object($conditions) || Utils::isAssociativeArray($conditions)) {
            Assert::isSdkObject($conditions, Condition::class);
        } else {
            Assert::isArray($conditions);
            Assert::allIsSdkObject($conditions, Condition::class);
        }

        $this->conditions = Utils::isAssociativeArray($conditions)
            ? new Condition($conditions)
            : $conditions;
        return $this;
    }

    /**
     * Get the hidden
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Set the hidden
     * @param boolean $hidden
     * @return $this
     */
    public function setHidden($hidden)
    {
        if (is_null($hidden)) {
            $this->hidden = null;
            return $this;
        }

        Assert::boolean($hidden);

        $this->hidden = $hidden;
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
        if (is_null($layout)) {
            $this->layout = null;
            return $this;
        }

        if (is_object($layout) || Utils::isAssociativeArray($layout)) {
            Assert::isSdkObject($layout, ComponentLayout::class);
        } else {
            Assert::string($layout);
        }

        $this->layout = Utils::isAssociativeArray($layout) ? new ComponentLayout($layout) : $layout;
        return $this;
    }

    /**
     * Get the style
     * @return \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the style
     * @param \Urbania\AppleNews\Format\ComponentStyle|array|string|none $style
     * @return $this
     */
    public function setStyle($style)
    {
        if (is_null($style)) {
            $this->style = null;
            return $this;
        }

        if (is_object($style) || Utils::isAssociativeArray($style)) {
            Assert::isSdkObject($style, ComponentStyle::class);
        } else {
            Assert::string($style);
        }

        $this->style = Utils::isAssociativeArray($style) ? new ComponentStyle($style) : $style;
        return $this;
    }

    /**
     * Get the textStyle
     * @return \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    public function getTextStyle()
    {
        return $this->textStyle;
    }

    /**
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\ComponentTextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_null($textStyle)) {
            $this->textStyle = null;
            return $this;
        }

        if (is_object($textStyle) || Utils::isAssociativeArray($textStyle)) {
            Assert::isSdkObject($textStyle, ComponentTextStyle::class);
        } else {
            Assert::string($textStyle);
        }

        $this->textStyle = Utils::isAssociativeArray($textStyle)
            ? new ComponentTextStyle($textStyle)
            : $textStyle;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->conditions)) {
            $data['conditions'] =
                $this->conditions instanceof Arrayable
                    ? $this->conditions->toArray()
                    : $this->conditions;
        }
        if (isset($this->anchor)) {
            $data['anchor'] =
                $this->anchor instanceof Arrayable ? $this->anchor->toArray() : $this->anchor;
        }
        if (isset($this->animation)) {
            $data['animation'] =
                $this->animation instanceof Arrayable
                    ? $this->animation->toArray()
                    : $this->animation;
        }
        if (isset($this->behavior)) {
            $data['behavior'] =
                $this->behavior instanceof Arrayable ? $this->behavior->toArray() : $this->behavior;
        }
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] =
                $this->textStyle instanceof Arrayable
                    ? $this->textStyle->toArray()
                    : $this->textStyle;
        }
        return $data;
    }
}