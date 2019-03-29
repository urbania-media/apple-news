<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the object that wraps the throttling information that's returned
 * for the publish article and read article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/meta
 */
class Meta extends BaseSdkObject
{
    /**
     * The process responsible for regulating the rate at which requests are
     * processed.
     * @var \Urbania\AppleNews\Api\Objects\Throttling
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
     * @return \Urbania\AppleNews\Api\Objects\Throttling
     */
    public function getThrottling()
    {
        return $this->throttling;
    }

    /**
     * Set the throttling
     * @param \Urbania\AppleNews\Api\Objects\Throttling|array $throttling
     * @return $this
     */
    public function setThrottling($throttling)
    {
        if (is_null($throttling)) {
            $this->throttling = null;
            return $this;
        }

        Assert::isSdkObject($throttling, Throttling::class);

        $this->throttling = is_array($throttling)
            ? new Throttling($throttling)
            : $throttling;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->throttling)) {
            $data['throttling'] =
                $this->throttling instanceof Arrayable
                    ? $this->throttling->toArray()
                    : $this->throttling;
        }
        return $data;
    }
}
