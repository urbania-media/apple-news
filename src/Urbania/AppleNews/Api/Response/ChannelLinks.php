<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

class ChannelLinks extends Response
{
    /** @var string */
    protected $defaultSection;

    /** @var string */
    protected $self;

    public function __construct(array $data = [])
    {
        if (isset($data['defaultSection'])) {
            $this->setDefaultSection($data['defaultSection']);
        }

        if (isset($data['self'])) {
            $this->setSelf($data['self']);
        }
    }

    /**
     * Get the defaultSection
     * @return string
     */
    public function getDefaultSection()
    {
        return $this->defaultSection;
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
     * Set the defaultSection
     * @param string $defaultSection
     * @return $this
     */
    public function setDefaultSection($defaultSection)
    {
        Assert::string($defaultSection);

        $this->defaultSection = $defaultSection;
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
            'defaultSection' => $this->defaultSection,
            'self' => $this->self
        ];
    }
}
