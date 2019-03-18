<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the links returned by the search article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/searchresponse/links
 */
class SearchResponseLinks
{
    /**
     * The URL for the current page of search results.
     * @var string
     */
    protected $self;

    /**
     * The URL for the next page of search results. If next is null, there
     * are no more pages. The next link may occasionally return an empty page
     * of results (if, for example, an article in the original set of search
     * results has been deleted since the results were obtained).
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
     * Get the self
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Set the next
     * @param string $next
     * @return $this
     */
    public function setNext($next)
    {
        Assert::string($next);

        $this->next = $next;
        return $this;
    }

    /**
     * Set the self
     * @param string $self
     * @return $this
     */
    public function setSelf($self)
    {
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
        return [
            'self' => $this->self,
            'next' => $this->next
        ];
    }
}
