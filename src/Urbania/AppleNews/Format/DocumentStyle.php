<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for setting the background color for your article.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/documentstyle.json
 */
class DocumentStyle extends BaseSdkObject
{
    /**
     * The article’s background color. The value defaults to white.
     * @var string
     */
    protected $backgroundColor;

    /**
     * An instance or array of document style properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalDocumentStyle[]|\Urbania\AppleNews\Format\ConditionalDocumentStyle
     */
    protected $conditional;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalDocumentStyle[]|\Urbania\AppleNews\Format\ConditionalDocumentStyle
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalDocumentStyle[]|\Urbania\AppleNews\Format\ConditionalDocumentStyle|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalDocumentStyle::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalDocumentStyle::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalDocumentStyle($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->conditional)) {
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
                    : $this->conditional;
        }
        return $data;
    }
}
