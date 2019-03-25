<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The animation in which a component scales up and fades into view.
 *
 * @see https://developer.apple.com/documentation/apple_news/scalefadeanimation
 */
class ScaleFadeAnimation extends ComponentAnimation
{
    /**
     * Always scale_fade for this animation type.
     * @var string
     */
    protected $type = 'scale_fade';

    /**
     * The initial transparency of the component. Set initialAlpha to a value
     * between 0 (completely transparent) and 1 (completely opaque).
     * @var float|integer
     */
    protected $initialAlpha;

    /**
     * The initial scale of the component. Set initialScale to a value
     * between 0 (completely scaled down) and 1 (the component’s original
     * size).
     * @var float|integer
     */
    protected $initialScale;

    /**
     * A Boolean value that indicates whether the animation occurs in
     * response to user action (true) or happens automatically (false).
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
     * @return float|integer
     */
    public function getInitialAlpha()
    {
        return $this->initialAlpha;
    }

    /**
     * Set the initialAlpha
     * @param float|integer $initialAlpha
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
     * @return float|integer
     */
    public function getInitialScale()
    {
        return $this->initialScale;
    }

    /**
     * Set the initialScale
     * @param float|integer $initialScale
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
