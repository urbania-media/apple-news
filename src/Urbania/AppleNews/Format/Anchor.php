<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for anchoring one component to another component in your
 * article’s layout.
 *
 * @see https://developer.apple.com/documentation/apple_news/anchor
 */
class Anchor
{
    /**
     * Sets which point in the origin component will get anchored to the
     * target component. The originating anchor will be positioned as closely
     * as possible to the intended targetAnchorPosition. If this property is
     * omitted, the value of targetAnchorPosition will be used.
     * @var string
     */
    protected $originAnchorPosition;

    /**
     * The length of the range of text the component should be anchored to.
     * If rangeLength is specified, rangeStart is required.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The start index of the range of text the component should be anchored
     * to. When a component is anchored to a component with a role of body,
     * the text might be flowed around the component.
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
     * Sets the anchor point in the target component, relative to the
     * originAnchorPosition. Valid values:
     * @var string
     */
    protected $targetAnchorPosition;

    /**
     * The identifier of the component to anchor to.
     * targetComponentIdentifier cannot refer to the current component’s
     * parent, child components, or components in another container. When
     * this property is omitted, the anchor will be applied to the parent
     * component, if one exists.
     * @var string
     */
    protected $targetComponentIdentifier;

    public function __construct(array $data = [])
    {
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

        if (isset($data['targetAnchorPosition'])) {
            $this->setTargetAnchorPosition($data['targetAnchorPosition']);
        }

        if (isset($data['targetComponentIdentifier'])) {
            $this->setTargetComponentIdentifier(
                $data['targetComponentIdentifier']
            );
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
     * Get the rangeLength
     * @return integer
     */
    public function getRangeLength()
    {
        return $this->rangeLength;
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
     * Get the target
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
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
     * Get the targetComponentIdentifier
     * @return string
     */
    public function getTargetComponentIdentifier()
    {
        return $this->targetComponentIdentifier;
    }

    /**
     * Set the originAnchorPosition
     * @param string $originAnchorPosition
     * @return $this
     */
    public function setOriginAnchorPosition($originAnchorPosition)
    {
        Assert::oneOf($originAnchorPosition, ["top", "center", "bottom"]);

        $this->originAnchorPosition = $originAnchorPosition;
        return $this;
    }

    /**
     * Set the rangeLength
     * @param integer $rangeLength
     * @return $this
     */
    public function setRangeLength($rangeLength)
    {
        Assert::integer($rangeLength);

        $this->rangeLength = $rangeLength;
        return $this;
    }

    /**
     * Set the rangeStart
     * @param integer $rangeStart
     * @return $this
     */
    public function setRangeStart($rangeStart)
    {
        Assert::integer($rangeStart);

        $this->rangeStart = $rangeStart;
        return $this;
    }

    /**
     * Set the target
     * @param string $target
     * @return $this
     */
    public function setTarget($target)
    {
        Assert::string($target);

        $this->target = $target;
        return $this;
    }

    /**
     * Set the targetAnchorPosition
     * @param string $targetAnchorPosition
     * @return $this
     */
    public function setTargetAnchorPosition($targetAnchorPosition)
    {
        Assert::oneOf($targetAnchorPosition, ["top", "center", "bottom"]);

        $this->targetAnchorPosition = $targetAnchorPosition;
        return $this;
    }

    /**
     * Set the targetComponentIdentifier
     * @param string $targetComponentIdentifier
     * @return $this
     */
    public function setTargetComponentIdentifier($targetComponentIdentifier)
    {
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
        return [
            'originAnchorPosition' => $this->originAnchorPosition,
            'rangeLength' => $this->rangeLength,
            'rangeStart' => $this->rangeStart,
            'target' => $this->target,
            'targetAnchorPosition' => $this->targetAnchorPosition,
            'targetComponentIdentifier' => $this->targetComponentIdentifier
        ];
    }
}
