<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The animation whereby a component moves in from the side of the
 * screen.
 *
 * @see https://developer.apple.com/documentation/apple_news/moveinanimation
 */
class MoveInAnimation extends ComponentAnimation
{
    /**
     * Indicates which side of the screen should be the starting point of the
     * animation. Valid values:
     * @var string
     */
    protected $preferredStartingPosition;

    /**
     * This animation’s type is always move_in.
     * @var string
     */
    protected $type = 'move_in';

    /**
     * Indicates whether the animation occurs in response to user action
     * (true) or happens automatically (false).
     * @var boolean
     */
    protected $userControllable;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['preferredStartingPosition'])) {
            $this->setPreferredStartingPosition(
                $data['preferredStartingPosition']
            );
        }

        if (isset($data['userControllable'])) {
            $this->setUserControllable($data['userControllable']);
        }
    }

    /**
     * Get the preferredStartingPosition
     * @return string
     */
    public function getPreferredStartingPosition()
    {
        return $this->preferredStartingPosition;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the userControllable
     * @return boolean
     */
    public function getUserControllable()
    {
        return $this->userControllable;
    }

    /**
     * Set the preferredStartingPosition
     * @param string $preferredStartingPosition
     * @return $this
     */
    public function setPreferredStartingPosition($preferredStartingPosition)
    {
        Assert::oneOf($preferredStartingPosition, ["left", "right"]);

        $this->preferredStartingPosition = $preferredStartingPosition;
        return $this;
    }

    /**
     * Set the userControllable
     * @param boolean $userControllable
     * @return $this
     */
    public function setUserControllable($userControllable)
    {
        Assert::boolean($userControllable);

        $this->userControllable = $userControllable;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'preferredStartingPosition' => $this->preferredStartingPosition,
            'type' => $this->type,
            'userControllable' => $this->userControllable
        ]);
    }
}
