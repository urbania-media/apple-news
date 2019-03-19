<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for defining a horizontal line to visually divide parts
 * of your article.
 *
 * @see https://developer.apple.com/documentation/apple_news/divider
 */
class Divider extends Component
{
    /**
     * This component always has the role of divider.
     * @var string
     */
    protected $role;

    /**
     * Stroke properties to apply to the horizontal line.
     * @var \Urbania\AppleNews\Format\StrokeStyle
     */
    protected $stroke;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['role'])) {
            $this->setRole($data['role']);
        }

        if (isset($data['stroke'])) {
            $this->setStroke($data['stroke']);
        }
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
     * Set the role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        Assert::string($role);

        $this->role = $role;
        return $this;
    }

    /**
     * Get the stroke
     * @return \Urbania\AppleNews\Format\StrokeStyle
     */
    public function getStroke()
    {
        return $this->stroke;
    }

    /**
     * Set the stroke
     * @param \Urbania\AppleNews\Format\StrokeStyle|array $stroke
     * @return $this
     */
    public function setStroke($stroke)
    {
        if (is_null($stroke)) {
            $this->stroke = null;
            return $this;
        }

        if (is_object($stroke)) {
            Assert::isInstanceOf($stroke, StrokeStyle::class);
        } else {
            Assert::isArray($stroke);
        }

        $this->stroke = is_array($stroke) ? new StrokeStyle($stroke) : $stroke;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->stroke)) {
            $data['stroke'] = is_object($this->stroke)
                ? $this->stroke->toArray()
                : $this->stroke;
        }
        return $data;
    }
}
