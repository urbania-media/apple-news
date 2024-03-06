<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for applying text styling when not using HTML or Markdown
 * formatting.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/inlinetextstyle.json
 */
class InlineTextStyle extends BaseSdkObject
{
    /**
     * The length (in characters) of the portion of text to which the
     * alternative styling should be applied.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The starting point of the text to which the alternative styling should
     * be applied. Note: the first available character is at , not 1.
     * @var integer
     */
    protected $rangeStart;

    /**
     * Either a text style object or the name of a  object defined in the
     * object.
     * @var \Urbania\AppleNews\Format\TextStyle|string
     */
    protected $textStyle;

    public function __construct(array $data = [])
    {
        if (isset($data['rangeLength'])) {
            $this->setRangeLength($data['rangeLength']);
        }

        if (isset($data['rangeStart'])) {
            $this->setRangeStart($data['rangeStart']);
        }

        if (isset($data['textStyle'])) {
            $this->setTextStyle($data['textStyle']);
        }
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
        Assert::integer($rangeStart);

        $this->rangeStart = $rangeStart;
        return $this;
    }

    /**
     * Get the textStyle
     * @return \Urbania\AppleNews\Format\TextStyle|string
     */
    public function getTextStyle()
    {
        return $this->textStyle;
    }

    /**
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\TextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_object($textStyle) || Utils::isAssociativeArray($textStyle)) {
            Assert::isSdkObject($textStyle, TextStyle::class);
        } else {
            Assert::string($textStyle);
        }

        $this->textStyle = Utils::isAssociativeArray($textStyle)
            ? new TextStyle($textStyle)
            : $textStyle;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->rangeLength)) {
            $data['rangeLength'] = $this->rangeLength;
        }
        if (isset($this->rangeStart)) {
            $data['rangeStart'] = $this->rangeStart;
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
