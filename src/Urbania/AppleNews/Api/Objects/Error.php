<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the properties of an error the Apple News API returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/error.json
 */
class Error extends BaseSdkObject
{
    /**
     * An error code that, in combination with the key path, uniquely
     * identifies the error for the specified endpoint.
     * Returned: Always
     * @var string
     */
    protected $code;

    /**
     * An array of field names that uniquely identifies a field in the JSON
     * input of the request. See .
     * Returned: Sometimes
     * @var array
     */
    protected $keyPath;

    /**
     * A user-friendly, detailed explanation of the error code.
     * Returned: Sometimes
     * @var string
     */
    protected $message;

    /**
     * A code the server issues in response to a request.
     * Returned: Always
     * @var string
     */
    protected $status;

    /**
     * If applicable, the value supplied in the request for the field that
     * keyPath specifies.
     * ReturnedSometimes
     * @var string
     */
    protected $value;

    public function __construct(array $data = [])
    {
        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['keyPath'])) {
            $this->setKeyPath($data['keyPath']);
        }

        if (isset($data['message'])) {
            $this->setMessage($data['message']);
        }

        if (isset($data['status'])) {
            $this->setStatus($data['status']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
    }

    /**
     * Get the code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the code
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        if (is_null($code)) {
            $this->code = null;
            return $this;
        }

        Assert::string($code);

        $this->code = $code;
        return $this;
    }

    /**
     * Add an item to keyPath
     * @param array $item
     * @return $this
     */
    public function addKeyPath($item)
    {
        return $this->setKeyPath(
            !is_null($this->keyPath) ? array_merge($this->keyPath, [$item]) : [$item]
        );
    }

    /**
     * Get the keyPath
     * @return array
     */
    public function getKeyPath()
    {
        return $this->keyPath;
    }

    /**
     * Set the keyPath
     * @param array $keyPath
     * @return $this
     */
    public function setKeyPath($keyPath)
    {
        if (is_null($keyPath)) {
            $this->keyPath = null;
            return $this;
        }

        Assert::isArray($keyPath);

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
     * Get the status
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the status
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            $this->status = null;
            return $this;
        }

        Assert::integer($status);

        $this->status = $status;
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
        if (isset($this->code)) {
            $data['code'] = $this->code instanceof Arrayable ? $this->code->toArray() : $this->code;
        }
        if (isset($this->keyPath)) {
            $data['keyPath'] = $this->keyPath;
        }
        if (isset($this->message)) {
            $data['message'] = $this->message;
        }
        if (isset($this->status)) {
            $data['status'] =
                $this->status instanceof Arrayable ? $this->status->toArray() : $this->status;
        }
        if (isset($this->value)) {
            $data['value'] = $this->value;
        }
        return $data;
    }
}
