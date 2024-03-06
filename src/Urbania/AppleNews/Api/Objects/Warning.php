<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the properties of a warning the Apple News API returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/warning.json
 */
class Warning extends BaseSdkObject
{
    /**
     * An array of field names that uniquely identifies a field in the JSON
     * input of the request.
     * @var array
     */
    protected $keypath;

    /**
     * A user-friendly, detailed explanation of the nonfatal warning.
     * @var string
     */
    protected $message;

    /**
     * If applicable, the value supplied in the request for the field that
     * keyPath specifies.
     * @var string
     */
    protected $value;

    public function __construct(array $data = [])
    {
        if (isset($data['keypath'])) {
            $this->setKeypath($data['keypath']);
        }

        if (isset($data['message'])) {
            $this->setMessage($data['message']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
    }

    /**
     * Add an item to keypath
     * @param array $item
     * @return $this
     */
    public function addKeypath($item)
    {
        return $this->setKeypath(
            !is_null($this->keypath) ? array_merge($this->keypath, [$item]) : [$item]
        );
    }

    /**
     * Get the keypath
     * @return array
     */
    public function getKeypath()
    {
        return $this->keypath;
    }

    /**
     * Set the keypath
     * @param array $keypath
     * @return $this
     */
    public function setKeypath($keypath)
    {
        if (is_null($keypath)) {
            $this->keypath = null;
            return $this;
        }

        Assert::isArray($keypath);

        $this->keypath = $keypath;
        return $this;
    }

    /**
     * Get the message
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the message
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        if (is_null($message)) {
            $this->message = null;
            return $this;
        }

        Assert::string($message);

        $this->message = $message;
        return $this;
    }

    /**
     * Get the value
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        if (is_null($value)) {
            $this->value = null;
            return $this;
        }

        Assert::string($value);

        $this->value = $value;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->keypath)) {
            $data['keypath'] = $this->keypath;
        }
        if (isset($this->message)) {
            $data['message'] = $this->message;
        }
        if (isset($this->value)) {
            $data['value'] = $this->value;
        }
        return $data;
    }
}
