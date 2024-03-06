<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the style for bulleted or numbered lists in an
 * article.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/listitemstyle.json
 */
class ListItemStyle extends BaseSdkObject
{
    /**
     * The type of list item indicator to use.
     * Allowed options are:
     * @var string
     */
    protected $type;

    /**
     * If type is set to character, provide the character to use as the list
     * item indicator. Only a single character is supported.
     * @var string
     */
    protected $character;

    public function __construct(array $data = [])
    {
        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['character'])) {
            $this->setCharacter($data['character']);
        }
    }

    /**
     * Get the character
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set the character
     * @param string $character
     * @return $this
     */
    public function setCharacter($character)
    {
        if (is_null($character)) {
            $this->character = null;
            return $this;
        }

        Assert::string($character);

        $this->character = $character;
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::oneOf($type, [
            'bullet',
            'decimal',
            'lower_roman',
            'upper_roman',
            'lower_alphabetical',
            'upper_alphabetical',
            'character',
            'none',
        ]);

        $this->type = $type;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->character)) {
            $data['character'] = $this->character;
        }
        return $data;
    }
}
