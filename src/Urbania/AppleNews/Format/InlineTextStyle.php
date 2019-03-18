<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for applying text styling when not using HTML or Markdown
 * formatting.
 *
 * @see https://developer.apple.com/documentation/apple_news/inlinetextstyle
 */
class InlineTextStyle
{
    /**
     * The length (in characters) of the portion of text to which the
     * alternative styling should be applied.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The starting point of the text to which the alternative styling should
     * be applied. Note: the first available character is at 0, not 1.
     * @var integer
     */
    protected $rangeStart;

    /**
     * Either a TextStyle or the name of a TextStyle object defined in the
     * ArticleDocument.textStyles object.
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
     * Get the rangeStart
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
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
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\TextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_object($textStyle)) {
            Assert::isInstanceOf($textStyle, TextStyle::class);
        } elseif (!is_array($textStyle)) {
            Assert::string($textStyle);
        }

        $this->textStyle = is_array($textStyle)
            ? new TextStyle($textStyle)
            : $textStyle;
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
        if (isset($this->rangeLength)) {
            $data['rangeLength'] = $this->rangeLength;
        }
        if (isset($this->rangeStart)) {
            $data['rangeStart'] = $this->rangeStart;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] = is_object($this->textStyle)
                ? $this->textStyle->toArray()
                : $this->textStyle;
        }
        return $data;
    }
}
