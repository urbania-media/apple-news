<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The text component for adding a heading.
 *
 * @see https://developer.apple.com/documentation/apple_news/heading
 */
class Heading extends Text implements \JsonSerializable
{
    /**
     * A heading component has one of these values for role: heading,
     * heading1, heading2, heading3, heading4, heading5, or heading6.
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
        Assert::oneOf($role, [
            "heading",
            "heading1",
            "heading2",
            "heading3",
            "heading4",
            "heading5",
            "heading6"
        ]);

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
