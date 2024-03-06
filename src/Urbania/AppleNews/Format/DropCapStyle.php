<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the drop cap text style for use in the first
 * paragraph in a text component.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/dropcapstyle.json
 */
class DropCapStyle extends BaseSdkObject
{
    /**
     * The approximate number of text lines this drop cap should span. For
     * example, if numberOfLines is set to 3, and the top of the drop cap is
     * aligned with the top of the first line, the bottom of the drop cap
     * will drop to the bottom of the third line, although the actual drop
     * amount can vary depending on the device and its orientation.
     * @var integer
     */
    protected $numberOfLines;

    /**
     * The background color of the drop cap. By default, no background color
     * is applied, making the background effectively transparent.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The PostScript name of the font to use for the drop cap. By default,
     * the drop cap inherits the font of the component it’s in.
     * @var string
     */
    protected $fontName;

    /**
     * A number that indicates the characters to render in the drop cap
     * style.
     * Default value: 1
     * @var integer
     */
    protected $numberOfCharacters;

    /**
     * The number of text lines this drop cap should raise. For example: When
     * numberOfRaisedLines is 3, and numberOfLines is 5, the top of the drop
     * cap is raised above the first line by 3 lines and and the bottom of
     * the drop cap drops to the bottom of the second line.
     * @var integer
     */
    protected $numberOfRaisedLines;

    /**
     * A number thay sets the padding of the drop cap in points. When padding
     * is applied, the drop cap is smaller than the box that surrounds it.
     * Default value:
     * @var integer
     */
    protected $padding;

    /**
     * The color of the drop cap. The color defaults to the color of the
     * associated text.
     * @var string
     */
    protected $textColor;

    public function __construct(array $data = [])
    {
        if (isset($data['numberOfLines'])) {
            $this->setNumberOfLines($data['numberOfLines']);
        }

        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['fontName'])) {
            $this->setFontName($data['fontName']);
        }

        if (isset($data['numberOfCharacters'])) {
            $this->setNumberOfCharacters($data['numberOfCharacters']);
        }

        if (isset($data['numberOfRaisedLines'])) {
            $this->setNumberOfRaisedLines($data['numberOfRaisedLines']);
        }

        if (isset($data['padding'])) {
            $this->setPadding($data['padding']);
        }

        if (isset($data['textColor'])) {
            $this->setTextColor($data['textColor']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the fontName
     * @return string
     */
    public function getFontName()
    {
        return $this->fontName;
    }

    /**
     * Set the fontName
     * @param string $fontName
     * @return $this
     */
    public function setFontName($fontName)
    {
        if (is_null($fontName)) {
            $this->fontName = null;
            return $this;
        }

        Assert::string($fontName);

        $this->fontName = $fontName;
        return $this;
    }

    /**
     * Get the numberOfCharacters
     * @return integer
     */
    public function getNumberOfCharacters()
    {
        return $this->numberOfCharacters;
    }

    /**
     * Set the numberOfCharacters
     * @param integer $numberOfCharacters
     * @return $this
     */
    public function setNumberOfCharacters($numberOfCharacters)
    {
        if (is_null($numberOfCharacters)) {
            $this->numberOfCharacters = null;
            return $this;
        }

        Assert::integer($numberOfCharacters);

        $this->numberOfCharacters = $numberOfCharacters;
        return $this;
    }

    /**
     * Get the numberOfLines
     * @return integer
     */
    public function getNumberOfLines()
    {
        return $this->numberOfLines;
    }

    /**
     * Set the numberOfLines
     * @param integer $numberOfLines
     * @return $this
     */
    public function setNumberOfLines($numberOfLines)
    {
        Assert::integer($numberOfLines);

        $this->numberOfLines = $numberOfLines;
        return $this;
    }

    /**
     * Get the numberOfRaisedLines
     * @return integer
     */
    public function getNumberOfRaisedLines()
    {
        return $this->numberOfRaisedLines;
    }

    /**
     * Set the numberOfRaisedLines
     * @param integer $numberOfRaisedLines
     * @return $this
     */
    public function setNumberOfRaisedLines($numberOfRaisedLines)
    {
        if (is_null($numberOfRaisedLines)) {
            $this->numberOfRaisedLines = null;
            return $this;
        }

        Assert::integer($numberOfRaisedLines);

        $this->numberOfRaisedLines = $numberOfRaisedLines;
        return $this;
    }

    /**
     * Get the padding
     * @return integer
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Set the padding
     * @param integer $padding
     * @return $this
     */
    public function setPadding($padding)
    {
        if (is_null($padding)) {
            $this->padding = null;
            return $this;
        }

        Assert::integer($padding);

        $this->padding = $padding;
        return $this;
    }

    /**
     * Get the textColor
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set the textColor
     * @param string $textColor
     * @return $this
     */
    public function setTextColor($textColor)
    {
        if (is_null($textColor)) {
            $this->textColor = null;
            return $this;
        }

        Assert::isColor($textColor);

        $this->textColor = $textColor;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->numberOfLines)) {
            $data['numberOfLines'] = $this->numberOfLines;
        }
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->fontName)) {
            $data['fontName'] = $this->fontName;
        }
        if (isset($this->numberOfCharacters)) {
            $data['numberOfCharacters'] = $this->numberOfCharacters;
        }
        if (isset($this->numberOfRaisedLines)) {
            $data['numberOfRaisedLines'] = $this->numberOfRaisedLines;
        }
        if (isset($this->padding)) {
            $data['padding'] = $this->padding;
        }
        if (isset($this->textColor)) {
            $data['textColor'] =
                $this->textColor instanceof Arrayable
                    ? $this->textColor->toArray()
                    : $this->textColor;
        }
        return $data;
    }
}
