<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding a medium, fixed-size rectangle ad.
 *
 * @see https://developer.apple.com/documentation/apple_news/mediumrectangleadvertisement
 */
class MediumRectangleAdvertisement extends Component
{
    /**
     * This component always has a role of medium_rectangle_advertisement.
     * @var string
     */
    protected $role = 'medium_rectangle_advertisement';

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
