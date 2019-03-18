<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the object that wraps the throttling information that's returned
 * for the publish article and read article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/meta
 */
class Meta implements \JsonSerializable
{
    /**
     * Indicates the process responsible for regulating the rate at which
     * requests are processed.
     * @var \Urbania\AppleNews\Api\Response\Throttling
     */
    protected $throttling;

    public function __construct(array $data = [])
    {
        if (isset($data['throttling'])) {
            $this->setThrottling($data['throttling']);
        }
    }

    /**
     * Get the throttling
     * @return \Urbania\AppleNews\Api\Response\Throttling
     */
    public function getThrottling()
    {
        return $this->throttling;
    }

    /**
     * Set the throttling
     * @param \Urbania\AppleNews\Api\Response\Throttling|array $throttling
     * @return $this
     */
    public function setThrottling($throttling)
    {
        if (is_object($throttling)) {
            Assert::isInstanceOf($throttling, Throttling::class);
        } else {
            Assert::isArray($throttling);
        }

        $this->throttling = is_array($throttling)
            ? new Throttling($throttling)
            : $throttling;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        if (isset($this->throttling)) {
            $data['throttling'] = is_object($this->throttling)
                ? $this->throttling->toArray()
                : $this->throttling;
        }
        return $data;
    }
}
