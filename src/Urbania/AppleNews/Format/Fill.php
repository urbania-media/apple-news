<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for setting a fill type and attachment for a component’s
 * background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/fill
 */
class Fill
{
    /**
     * Indicates how the fill should behave when a user scrolls. Valid
     * values:
     * @var string
     */
    protected $attachment;

    /**
     * The type of fill to apply.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['attachment'])) {
            $this->setAttachment($data['attachment']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
    }

    /**
     * Get the attachment
     * @return string
     */
    public function getAttachment()
    {
        return $this->attachment;
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
     * Set the attachment
     * @param string $attachment
     * @return $this
     */
    public function setAttachment($attachment)
    {
        Assert::oneOf($attachment, ["fixed", "scroll"]);

        $this->attachment = $attachment;
        return $this;
    }

    /**
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::string($type);

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
            'attachment' => $this->attachment,
            'type' => $this->type
        ];
    }
}
