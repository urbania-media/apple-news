<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The animation whereby a component fades into view.
 *
 * @see https://developer.apple.com/documentation/apple_news/fadeinanimation
 */
class FadeInAnimation extends ComponentAnimation
{
    /**
     * The initial transparency of the component. Set initialAlpha to a value
     * between 0 (completely transparent) and 1 (completely opaque).
     * @var integer|float
     */
    protected $initialAlpha;

    /**
     * This animation’s type is always fade_in.
     * @var string
     */
    protected $type = 'fade_in';

    /**
     * Indicates whether the animation occurs in response to user action
     * (true) or happens automatically (false).
     * @var boolean
     */
    protected $userControllable;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['initialAlpha'])) {
            $this->setInitialAlpha($data['initialAlpha']);
        }

        if (isset($data['userControllable'])) {
            $this->setUserControllable($data['userControllable']);
        }
    }

    /**
     * Get the initialAlpha
     * @return integer|float
     */
    public function getInitialAlpha()
    {
        return $this->initialAlpha;
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
     * Set the initialAlpha
     * @param integer|float $initialAlpha
     * @return $this
     */
    public function setInitialAlpha($initialAlpha)
    {
        Assert::number($initialAlpha);

        $this->initialAlpha = $initialAlpha;
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
            'initialAlpha' => $this->initialAlpha,
            'type' => $this->type,
            'userControllable' => $this->userControllable
        ]);
    }
}
