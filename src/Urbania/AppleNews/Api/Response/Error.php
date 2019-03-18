<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the properties of an error returned by the Apple News API.
 *
 * @see https://developer.apple.com/documentation/apple_news/error
 */
class Error
{
    /**
     * An error code that, in combination with the keyPath, uniquely
     * identifies the error for the specified endpoint.
     * @var \Urbania\AppleNews\Api\Response\Code
     */
    protected $code;

    /**
     * An array of field names that uniquely identifies a field in the JSON
     * input of the request. See Understanding the keyPath Array.
     * @var string[]
     */
    protected $keyPath;

    /**
     * A user friendly detailed explanation of the error code.
     * @var string
     */
    protected $message;

    /**
     * A code issued by the server in response to a request.
     * @var \Urbania\AppleNews\Api\Response\Status
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
     * @return \Urbania\AppleNews\Api\Response\Code
     */
    public function getCode()
    {
        return $this->code;
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
     * Get the message
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the status
     * @return \Urbania\AppleNews\Api\Response\Status
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set the code
     * @param \Urbania\AppleNews\Api\Response\Code|array $code
     * @return $this
     */
    public function setCode($code)
    {
        if (is_object($code)) {
            Assert::isInstanceOf($code, Code::class);
        } else {
            Assert::isArray($code);
        }

        $this->code = is_array($code) ? new Code($code) : $code;
        return $this;
    }

    /**
     * Set the keyPath
     * @param string[] $keyPath
     * @return $this
     */
    public function setKeyPath($keyPath)
    {
        Assert::isArray($keyPath);
        Assert::allString($keyPath);

        $this->keyPath = $keyPath;
        return $this;
    }

    /**
     * Set the message
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        Assert::string($message);

        $this->message = $message;
        return $this;
    }

    /**
     * Set the status
     * @param \Urbania\AppleNews\Api\Response\Status|array $status
     * @return $this
     */
    public function setStatus($status)
    {
        if (is_object($status)) {
            Assert::isInstanceOf($status, Status::class);
        } else {
            Assert::isArray($status);
        }

        $this->status = is_array($status) ? new Status($status) : $status;
        return $this;
    }

    /**
     * Set the value
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        Assert::string($value);

        $this->value = $value;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->code)) {
            $data['code'] = is_object($this->code)
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
            $data['status'] = is_object($this->status)
                ? $this->status->toArray()
                : $this->status;
        }
        if (isset($this->value)) {
            $data['value'] = $this->value;
        }
        return $data;
    }
}
