<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The animation whereby a component moves in from the side of the
 * screen.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/moveinanimation.json
 */
class MoveInAnimation extends ComponentAnimation
{
    /**
     * This animation always has the type move_in.
     * @var string
     */
    protected $type = 'move_in';

    /**
     * Indicates which side of the screen should be the starting point of the
     * animation. Valid values:
     * By default, the animation will start on the side that is closest to
     * the component.
     * @var string
     */
    protected $preferredStartingPosition;

    /**
     * Indicates whether the animation is controlled by (is in response to)
     * user action (true) or happens automatically (false).
     * @var boolean
     */
    protected $userControllable;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['preferredStartingPosition'])) {
            $this->setPreferredStartingPosition($data['preferredStartingPosition']);
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

        Assert::oneOf($preferredStartingPosition, ['left', 'right']);

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
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->preferredStartingPosition)) {
            $data['preferredStartingPosition'] = $this->preferredStartingPosition;
        }
        if (isset($this->userControllable)) {
            $data['userControllable'] = $this->userControllable;
        }
        return $data;
    }
}
