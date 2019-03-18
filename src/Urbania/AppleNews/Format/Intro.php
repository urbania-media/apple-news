<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding introductory text.
 *
 * @see https://developer.apple.com/documentation/apple_news/intro
 */
class Intro extends Text
{
    /**
     * This component always has a role of intro.
     * @var string
     */
    protected $role = 'intro';

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
