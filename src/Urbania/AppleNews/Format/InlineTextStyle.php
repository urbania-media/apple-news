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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'rangeLength' => $this->rangeLength,
            'rangeStart' => $this->rangeStart,
            'textStyle' => is_object($this->textStyle)
                ? $this->textStyle->toArray()
                : $this->textStyle
        ];
    }
}
