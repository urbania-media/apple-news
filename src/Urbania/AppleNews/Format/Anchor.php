<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for anchoring one component to another component in your
 * article’s layout.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/anchor.json
 */
class Anchor extends BaseSdkObject
{
    /**
     * Sets the anchor point in the target component, relative to the
     * originAnchorPosition. Valid values:
     * If a component is anchored to a range of text in a body component and
     * is full-width (such as on an iPhone), the following rules are used to
     * determine the spacing before and after the anchored component:
     *  Note the following:
     * Example: To align the bottom of a component with the bottom of another
     * component, both originAnchorPosition and targetAnchorPosition should
     * be set to bottom.
     * @var string
     */
    protected $targetAnchorPosition;

    /**
     * Sets which point in the origin component will get anchored to the
     * target component. The originating anchor will be positioned as closely
     * as possible to the intended targetAnchorPosition. If this property is
     * omitted, the value of targetAnchorPosition is used.
     * @var string
     */
    protected $originAnchorPosition;

    /**
     * The length of the range of text the component should be anchored to.
     * If rangeLength is specified, rangeStart is required.
     * Maximum value: (textLength - rangeStart)  where textLength is the
     * number of characters in the component, including spaces.
     * The length of a text range cannot exceed the length of the text.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The start index of the range of text the component should be anchored
     * to. When a component is anchored to a component with a role of body,
     * the text might be flowed around the component.
     * If rangeStart is specified, rangeLength is required.
     * @var integer
     */
    protected $rangeStart;

    /**
     * The id or name attribute of an HTML element in another component. The
     * component containing the target element must have format set to html.
     * @var string
     */
    protected $target;

    /**
     * The identifier of the component to anchor to.
     * targetComponentIdentifier cannot refer to the current component's
     * parent, child components, or components in another container. When
     * this property is omitted, the anchor will be applied to the parent
     * component, if one exists.
     * If a parent component does not exist and targetComponentIdentifier is
     * not specified, the anchor is ignored.
     * @var string
     */
    protected $targetComponentIdentifier;

    public function __construct(array $data = [])
    {
        if (isset($data['targetAnchorPosition'])) {
            $this->setTargetAnchorPosition($data['targetAnchorPosition']);
        }

        if (isset($data['originAnchorPosition'])) {
            $this->setOriginAnchorPosition($data['originAnchorPosition']);
        }

        if (isset($data['rangeLength'])) {
            $this->setRangeLength($data['rangeLength']);
        }

        if (isset($data['rangeStart'])) {
            $this->setRangeStart($data['rangeStart']);
        }

        if (isset($data['target'])) {
            $this->setTarget($data['target']);
        }

        if (isset($data['targetComponentIdentifier'])) {
            $this->setTargetComponentIdentifier($data['targetComponentIdentifier']);
        }
    }

    /**
     * Get the originAnchorPosition
     * @return string
     */
    public function getOriginAnchorPosition()
    {
        return $this->originAnchorPosition;
    }

    /**
     * Set the originAnchorPosition
     * @param string $originAnchorPosition
     * @return $this
     */
    public function setOriginAnchorPosition($originAnchorPosition)
    {
        if (is_null($originAnchorPosition)) {
            $this->originAnchorPosition = null;
            return $this;
        }

        Assert::oneOf($originAnchorPosition, ['top', 'center', 'bottom']);

        $this->originAnchorPosition = $originAnchorPosition;
        return $this;
    }

    /**
     * Get the rangeLength
     * @return integer
     */
    public function getRangeLength()
    {
        return $this->rangeLength;
    }

    /**
     * Set the rangeLength
     * @param integer $rangeLength
     * @return $this
     */
    public function setRangeLength($rangeLength)
    {
        if (is_null($rangeLength)) {
            $this->rangeLength = null;
            return $this;
        }

        Assert::integer($rangeLength);

        $this->rangeLength = $rangeLength;
        return $this;
    }

    /**
     * Get the rangeStart
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * Set the rangeStart
     * @param integer $rangeStart
     * @return $this
     */
    public function setRangeStart($rangeStart)
    {
        if (is_null($rangeStart)) {
            $this->rangeStart = null;
            return $this;
        }

        Assert::integer($rangeStart);

        $this->rangeStart = $rangeStart;
        return $this;
    }

    /**
     * Get the target
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set the target
     * @param string $target
     * @return $this
     */
    public function setTarget($target)
    {
        if (is_null($target)) {
            $this->target = null;
            return $this;
        }

        Assert::string($target);

        $this->target = $target;
        return $this;
    }

    /**
     * Get the targetAnchorPosition
     * @return string
     */
    public function getTargetAnchorPosition()
    {
        return $this->targetAnchorPosition;
    }

    /**
     * Set the targetAnchorPosition
     * @param string $targetAnchorPosition
     * @return $this
     */
    public function setTargetAnchorPosition($targetAnchorPosition)
    {
        Assert::oneOf($targetAnchorPosition, ['top', 'center', 'bottom']);

        $this->targetAnchorPosition = $targetAnchorPosition;
        return $this;
    }

    /**
     * Get the targetComponentIdentifier
     * @return string
     */
    public function getTargetComponentIdentifier()
    {
        return $this->targetComponentIdentifier;
    }

    /**
     * Set the targetComponentIdentifier
     * @param string $targetComponentIdentifier
     * @return $this
     */
    public function setTargetComponentIdentifier($targetComponentIdentifier)
    {
        if (is_null($targetComponentIdentifier)) {
            $this->targetComponentIdentifier = null;
            return $this;
        }

        Assert::string($targetComponentIdentifier);

        $this->targetComponentIdentifier = $targetComponentIdentifier;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->targetAnchorPosition)) {
            $data['targetAnchorPosition'] = $this->targetAnchorPosition;
        }
        if (isset($this->originAnchorPosition)) {
            $data['originAnchorPosition'] = $this->originAnchorPosition;
        }
        if (isset($this->rangeLength)) {
            $data['rangeLength'] = $this->rangeLength;
        }
        if (isset($this->rangeStart)) {
            $data['rangeStart'] = $this->rangeStart;
        }
        if (isset($this->target)) {
            $data['target'] = $this->target;
        }
        if (isset($this->targetComponentIdentifier)) {
            $data['targetComponentIdentifier'] = $this->targetComponentIdentifier;
        }
        return $data;
    }
}
