<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the object that wraps the throttling information that's returned
 * for the Create an Article and Read an Article endpoints.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/meta.json
 */
class Meta extends BaseSdkObject
{
    /**
     * The rate at which the server processes the requests.
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

        $this->throttling = Utils::isAssociativeArray($throttling)
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
