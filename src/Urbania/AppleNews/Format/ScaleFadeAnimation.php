<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The animation in which a component scales up and fades into view.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/scalefadeanimation.json
 */
class ScaleFadeAnimation extends ComponentAnimation
{
    /**
     * This animation always has the type scale_fade.
     * @var string
     */
    protected $type = 'scale_fade';

    /**
     * The initial transparency of the component (and the animation). Set
     * initialAlpha to a value between 0 (completely transparent) and 1
     * (completely visible).
     * @var integer|float
     */
    protected $initialAlpha;

    /**
     * The initial scale of the component (and the animation). Set
     * initialScale to a value between 0 (completely scaled down) and 1 (the
     * component’s original size).
     * @var integer|float
     */
    protected $initialScale;

    /**
     * Indicates whether the animation is controlled by (is in response to)
     * user action (true) or happens automatically (false).
     * @var boolean
     */
    protected $userControllable;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['initialAlpha'])) {
            $this->setInitialAlpha($data['initialAlpha']);
        }

        if (isset($data['initialScale'])) {
            $this->setInitialScale($data['initialScale']);
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
     * Get the initialScale
     * @return integer|float
     */
    public function getInitialScale()
    {
        return $this->initialScale;
    }

    /**
     * Set the initialScale
     * @param integer|float $initialScale
     * @return $this
     */
    public function setInitialScale($initialScale)
    {
        if (is_null($initialScale)) {
            $this->initialScale = null;
            return $this;
        }

        Assert::number($initialScale);

        $this->initialScale = $initialScale;
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
        if (isset($this->initialScale)) {
            $data['initialScale'] = $this->initialScale;
        }
        if (isset($this->userControllable)) {
            $data['userControllable'] = $this->userControllable;
        }
        return $data;
    }
}
