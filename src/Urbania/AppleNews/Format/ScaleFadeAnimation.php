<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The animation in which a component scales up and fades into view.
 *
 * @see https://developer.apple.com/documentation/apple_news/scalefadeanimation
 */
class ScaleFadeAnimation extends ComponentAnimation
{
    /**
     * The initial transparency of the component. Set initialAlpha to a value
     * between 0 (completely transparent) and 1 (completely opaque).
     * @var integer|float
     */
    protected $initialAlpha;

    /**
     * The initial scale of the component. Set initialScale to a value
     * between 0 (completely scaled down) and 1 (the component’s original
     * size).
     * @var integer|float
     */
    protected $initialScale;

    /**
     * This animation’s type is always scale_fade.
     * @var string
     */
    protected $type = 'scale_fade';

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
     * Get the initialScale
     * @return integer|float
     */
    public function getInitialScale()
    {
        return $this->initialScale;
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
     * Set the initialScale
     * @param integer|float $initialScale
     * @return $this
     */
    public function setInitialScale($initialScale)
    {
        Assert::number($initialScale);

        $this->initialScale = $initialScale;
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
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        if (isset($this->initialAlpha)) {
            $data['initialAlpha'] = $this->initialAlpha;
        }
        if (isset($this->initialScale)) {
            $data['initialScale'] = $this->initialScale;
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
