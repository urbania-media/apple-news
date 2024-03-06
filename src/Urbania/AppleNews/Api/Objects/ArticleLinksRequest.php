<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the required field for the Create an Article request.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articlelinksrequest.json
 */
class ArticleLinksRequest extends BaseSdkObject
{
    /**
     * The URL of the sections, if any, in which this article appears.
     * @var string[]
     */
    protected $sections;

    public function __construct(array $data = [])
    {
        if (isset($data['sections'])) {
            $this->setSections($data['sections']);
        }
    }

    /**
     * Add an item to sections
     * @param string $item
     * @return $this
     */
    public function addSection($item)
    {
        return $this->setSections(
            !is_null($this->sections) ? array_merge($this->sections, [$item]) : [$item]
        );
    }

    /**
     * Add items to sections
     * @param array $items
     * @return $this
     */
    public function addSections($items)
    {
        Assert::isArray($items);
        return $this->setSections(
            !is_null($this->sections) ? array_merge($this->sections, $items) : $items
        );
    }

    /**
     * Get the sections
     * @return string[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections
     * @param string[] $sections
     * @return $this
     */
    public function setSections($sections)
    {
        if (is_null($sections)) {
            $this->sections = null;
            return $this;
        }

        Assert::isArray($sections);
        Assert::allString($sections);

        $this->sections = $sections;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->sections)) {
            $data['sections'] = $this->sections;
        }
        return $data;
    }
}
