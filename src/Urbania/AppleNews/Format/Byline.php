<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding contributor credits, especially for articles
 * with multiple contributors.
 *
 * @see https://developer.apple.com/documentation/apple_news/byline
 */
class Byline extends Text implements \JsonSerializable
{
    /**
     * This component always has the role byline.
     * @var string
     */
    protected $role;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['role'])) {
            $this->setRole($data['role']);
        }
    }

    /**
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        Assert::string($role);

        $this->role = $role;
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
        $data = parent::toArray();
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        return $data;
    }
}
