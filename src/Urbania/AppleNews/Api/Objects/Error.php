<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the properties of an error returned by the Apple News API.
 *
 * @see https://developer.apple.com/documentation/apple_news/error
 */
class Error extends BaseSdkObject
{
    /**
     * An error code that, in combination with the keyPath, uniquely
     * identifies the error for the specified endpoint.
     * @var string
     */
    protected $code;

    /**
     * An array of field names that uniquely identifies a field in the JSON
     * input of the request. See Understanding the keyPath Array.
     * @var string[]
     */
    protected $keyPath = [];

    /**
     * A user friendly detailed explanation of the error code.
     * @var string
     */
    protected $message;

    /**
     * A code issued by the server in response to a request.
     * @var \Urbania\AppleNews\Api\Objects\Status
     */
    protected $status;

    /**
     * If applicable, the value supplied in the request for the field that is
     * specified by keyPath.
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
     * @param string $item
     * @return $this
     */
    public function addKeyPath($item)
    {
        return $this->setKeyPath(array_merge($this->keyPath, [$item]));
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
     * Get the status
     * @return \Urbania\AppleNews\Api\Objects\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the status
     * @param \Urbania\AppleNews\Api\Objects\Status|array $status
     * @return $this
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            $this->status = null;
            return $this;
        }

        Assert::isSdkObject($status, Status::class);

        $this->status = is_array($status) ? new Status($status) : $status;
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
            $data['code'] =
                $this->code instanceof Arrayable
                    ? $this->code->toArray()
                    : $this->code;
        }
        if (isset($this->keyPath)) {
            $data['keyPath'] = $this->keyPath;
        }
        if (isset($this->message)) {
            $data['message'] = $this->message;
        }
        if (isset($this->status)) {
            $data['status'] =
                $this->status instanceof Arrayable
                    ? $this->status->toArray()
                    : $this->status;
        }
        if (isset($this->value)) {
            $data['value'] = $this->value;
        }
        return $data;
    }
}
