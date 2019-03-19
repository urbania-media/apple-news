<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for setting a fill type and attachment for a component’s
 * background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/fill
 */
class Fill extends BaseSdkObject
{
    protected static $typeProperty = 'type';

    protected static $types = [
        'image' => 'ImageFill',
        'linear_gradient' => 'LinearGradientFill'
    ];

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

    public static function createTyped(array $data)
    {
        if (isset($data[static::$typeProperty])) {
            $typeName = $data[static::$typeProperty];
            $type = static::$types[$typeName] ?? null;
            if (!is_null($type)) {
                $namespace = implode(
                    '\\',
                    array_slice(explode('\\', static::class), 0, -1)
                );
                $typeClass = $namespace . '\\' . $type;
                return new $typeClass($data);
            }
        }

        return new static($data);
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
     * Set the attachment
     * @param string $attachment
     * @return $this
     */
    public function setAttachment($attachment)
    {
        if (is_null($attachment)) {
            $this->attachment = null;
            return $this;
        }

        Assert::oneOf($attachment, ["fixed", "scroll"]);

        $this->attachment = $attachment;
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
        $data = [];
        if (isset($this->attachment)) {
            $data['attachment'] = $this->attachment;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
