<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the properties of a warning returned by the Apple News API.
 *
 * @see https://developer.apple.com/documentation/apple_news/warning
 */
class Warning extends BaseSdkObject
{
    /**
     * An array of field names that uniquely identifies a field in the JSON
     * input of the request.
     * @var string[]
     */
    protected $keyPath;

    /**
     * A user friendly, detailed explanation of the non-fatal warning.
     * @var string
     */
    protected $message;

    /**
     * If applicable, the value supplied in the request for the field
     * specified by keyPath.
     * @var string
     */
    protected $value;

    public function __construct(array $data = [])
    {
        if (isset($data['keyPath'])) {
            $this->setKeyPath($data['keyPath']);
        }

        if (isset($data['message'])) {
            $this->setMessage($data['message']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
    }

    /**
     * Add an item to keyPath
     * @param string $item
     * @return $this
     */
    public function addKeyPath($item)
    {
        return $this->setKeyPath(
            !is_null($this->keyPath)
                ? array_merge($this->keyPath, [$item])
                : [$item]
        );
    }

    /**
     * Get the keyPath
     * @return string[]
     */
    public function getKeyPath()
    {
        return $this->keyPath;
    }

    /**
     * Set the keyPath
     * @param string[] $keyPath
     * @return $this
     */
    public function setKeyPath($keyPath)
    {
        if (is_null($keyPath)) {
            $this->keyPath = null;
            return $this;
        }

        Assert::isArray($keyPath);
        Assert::allString($keyPath);

        $this->keyPath = $keyPath;
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
        if (isset($this->keyPath)) {
            $data['keyPath'] = $this->keyPath;
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
