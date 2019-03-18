<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding caption text.
 *
 * @see https://developer.apple.com/documentation/apple_news/caption
 */
class Caption extends Text
{
    /**
     * This component always has a role of caption.
     * @var string
     */
    protected $role = 'caption';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'role' => $this->role
        ]);
    }
}
