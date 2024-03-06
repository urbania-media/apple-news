<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The animation whereby a component fades into view.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/fadeinanimation.json
 */
class FadeInAnimation extends ComponentAnimation
{
    /**
     * This animation always has the type fade_in.
     * @var string
     */
    protected $type = 'fade_in';

    /**
     * The initial transparency of the component (and the animation). Set
     * initialAlpha to a value between  (completely transparent) and 1
     * (completely visible).
     * @var integer|float
     */
    protected $initialAlpha;

    /**
     * Indicates whether the animation is controlled by  user action (true)
     * like scrolling, or happens when the component is within the visible
     * area of the document (false).
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
     * Set the initialAlpha
     * @param integer|float $initialAlpha
     * @return $this
     */
    public function setInitialAlpha($initialAlpha)
    {
        if (is_null($initialAlpha)) {
            $this->initialAlpha = null;
            return $this;
        }

        Assert::number($initialAlpha);

        $this->initialAlpha = $initialAlpha;
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
        if (isset($this->initialAlpha)) {
            $data['initialAlpha'] = $this->initialAlpha;
        }
        if (isset($this->userControllable)) {
            $data['userControllable'] = $this->userControllable;
        }
        return $data;
    }
}
