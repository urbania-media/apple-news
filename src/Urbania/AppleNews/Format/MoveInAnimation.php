<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

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
     * Set the preferredStartingPosition
     * @param string $preferredStartingPosition
     * @return $this
     */
    public function setPreferredStartingPosition($preferredStartingPosition)
    {
        if (is_null($preferredStartingPosition)) {
            $this->preferredStartingPosition = null;
            return $this;
        }

        Assert::oneOf($preferredStartingPosition, ["left", "right"]);

        $this->preferredStartingPosition = $preferredStartingPosition;
        return $this;
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
     * Set the userControllable
     * @param boolean $userControllable
     * @return $this
     */
    public function setUserControllable($userControllable)
    {
        if (is_null($userControllable)) {
            $this->userControllable = null;
            return $this;
        }

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
        $data = parent::toArray();
        if (isset($this->preferredStartingPosition)) {
            $data['preferredStartingPosition'] =
                $this->preferredStartingPosition;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->userControllable)) {
            $data['userControllable'] = $this->userControllable;
        }
        return $data;
    }
}
