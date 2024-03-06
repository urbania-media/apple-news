<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The scene that briefly keeps a header at the top of the screen as the
 * user scrolls through the article.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/fadingstickyheader.json
 */
class FadingStickyHeader extends Scene
{
    /**
     * The color the header background will fade to, defined as a 3- to
     * 8-character hexadecimal string or a color name string.
     * Default value: #000000 (black)
     * @var string
     */
    protected $fadeColor;

    /**
     * Always fading_sticky_header for this scene type.
     * @var string
     */
    protected $type = 'fading_sticky_header';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['fadeColor'])) {
            $this->setFadeColor($data['fadeColor']);
        }
    }

    /**
     * Get the fadeColor
     * @return string
     */
    public function getFadeColor()
    {
        return $this->fadeColor;
    }

    /**
     * Set the fadeColor
     * @param string $fadeColor
     * @return $this
     */
    public function setFadeColor($fadeColor)
    {
        if (is_null($fadeColor)) {
            $this->fadeColor = null;
            return $this;
        }

        Assert::isColor($fadeColor);

        $this->fadeColor = $fadeColor;
        return $this;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->fadeColor)) {
            $data['fadeColor'] =
                $this->fadeColor instanceof Arrayable
                    ? $this->fadeColor->toArray()
                    : $this->fadeColor;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
