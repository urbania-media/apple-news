<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining information about an issue.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/issue.json
 */
class Issue extends BaseSdkObject
{
    /**
     * A string that references an issue.
     * @var string
     */
    protected $identifier;

    /**
     * A number, supporting floats, that suggests the order in which the
     * article should appear in the issue.
     * @var integer|float
     */
    protected $order;

    /**
     * A string that represents a byline for the entire article. This string
     * is displayed in the table of contents.
     * @var string
     */
    protected $tocByline;

    public function __construct(array $data = [])
    {
        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['order'])) {
            $this->setOrder($data['order']);
        }

        if (isset($data['tocByline'])) {
            $this->setTocByline($data['tocByline']);
        }
    }

    /**
     * Get the identifier
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the identifier
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        Assert::string($identifier);

        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get the order
     * @return integer|float
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the order
     * @param integer|float $order
     * @return $this
     */
    public function setOrder($order)
    {
        if (is_null($order)) {
            $this->order = null;
            return $this;
        }

        Assert::number($order);

        $this->order = $order;
        return $this;
    }

    /**
     * Get the tocByline
     * @return string
     */
    public function getTocByline()
    {
        return $this->tocByline;
    }

    /**
     * Set the tocByline
     * @param string $tocByline
     * @return $this
     */
    public function setTocByline($tocByline)
    {
        if (is_null($tocByline)) {
            $this->tocByline = null;
            return $this;
        }

        Assert::string($tocByline);

        $this->tocByline = $tocByline;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->order)) {
            $data['order'] = $this->order;
        }
        if (isset($this->tocByline)) {
            $data['tocByline'] = $this->tocByline;
        }
        return $data;
    }
}
