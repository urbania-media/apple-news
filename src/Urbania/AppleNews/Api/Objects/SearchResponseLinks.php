<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the links the search article endpoints returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/searchresponse/links.json
 */
class SearchResponseLinks extends BaseSdkObject
{
    /**
     * The URL for the current page of search results.
     * @var string
     */
    protected $self;

    /**
     * The URL for the next page of search results. If next is null, there
     * are no more pages. The next link may occasionally return an empty page
     * of results.
     * @var string
     */
    protected $next;

    public function __construct(array $data = [])
    {
        if (isset($data['self'])) {
            $this->setSelf($data['self']);
        }

        if (isset($data['next'])) {
            $this->setNext($data['next']);
        }
    }

    /**
     * Get the next
     * @return string
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set the next
     * @param string $next
     * @return $this
     */
    public function setNext($next)
    {
        if (is_null($next)) {
            $this->next = null;
            return $this;
        }

        Assert::string($next);

        $this->next = $next;
        return $this;
    }

    /**
     * Get the self
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Set the self
     * @param string $self
     * @return $this
     */
    public function setSelf($self)
    {
        if (is_null($self)) {
            $this->self = null;
            return $this;
        }

        Assert::string($self);

        $this->self = $self;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->self)) {
            $data['self'] = $this->self;
        }
        if (isset($this->next)) {
            $data['next'] = $this->next;
        }
        return $data;
    }
}
