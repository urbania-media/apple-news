<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the style for bulleted or numbered lists in an
 * article.
 *
 * @see https://developer.apple.com/documentation/apple_news/listitemstyle
 */
class ListItemStyle
{
    /**
     * If type is set to character, provide the character to use as the list
     * item indicator. Only a single character is supported.
     * @var string
     */
    protected $character;

    /**
     * The type of list item indicator to use. Allowed options are:
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['character'])) {
            $this->setCharacter($data['character']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
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
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the character
     * @param string $character
     * @return $this
     */
    public function setCharacter($character)
    {
        Assert::string($character);

        $this->character = $character;
        return $this;
    }

    /**
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::oneOf($type, [
            "bullet",
            "decimal",
            "lower_roman",
            "upper_roman",
            "lower_alphabetical",
            "upper_alphabetical",
            "character",
            "none"
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
        return [
            'character' => $this->character,
            'type' => $this->type
        ];
    }
}
