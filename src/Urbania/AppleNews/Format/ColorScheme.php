<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object that contains information about the color scheme of the
 * document, including Dark Mode behavior.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articledocument/colorscheme.json
 */
class ColorScheme extends BaseSdkObject
{
    /**
     * A Boolean value that indicates whether automatic Dark Mode is enabled
     * for the document. The value for this property defaults to true, which
     * causes the document to be inverted when the user switches the device
     * to Dark Mode.
     * @var boolean
     */
    protected $automaticDarkModeEnabled;

    public function __construct(array $data = [])
    {
        if (isset($data['automaticDarkModeEnabled'])) {
            $this->setAutomaticDarkModeEnabled($data['automaticDarkModeEnabled']);
        }
    }

    /**
     * Get the automaticDarkModeEnabled
     * @return boolean
     */
    public function getAutomaticDarkModeEnabled()
    {
        return $this->automaticDarkModeEnabled;
    }

    /**
     * Set the automaticDarkModeEnabled
     * @param boolean $automaticDarkModeEnabled
     * @return $this
     */
    public function setAutomaticDarkModeEnabled($automaticDarkModeEnabled)
    {
        if (is_null($automaticDarkModeEnabled)) {
            $this->automaticDarkModeEnabled = null;
            return $this;
        }

        Assert::boolean($automaticDarkModeEnabled);

        $this->automaticDarkModeEnabled = $automaticDarkModeEnabled;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->automaticDarkModeEnabled)) {
            $data['automaticDarkModeEnabled'] = $this->automaticDarkModeEnabled;
        }
        return $data;
    }
}
