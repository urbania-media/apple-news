<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the object that wraps the throttling information that's returned
 * for the create article and update article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/throttling
 */
class Throttling implements \JsonSerializable
{
    /**
     * Estimate of the number of seconds until this request begins
     * processing.
     * @var integer
     */
    protected $estimatedDelayInSeconds;

    /**
     * A boolean value that indicates whether requests to this channel are
     * currently being throttled. If true, this request is added to the queue
     * to be processed later rather than immediately.
     * @var boolean
     */
    protected $isThrottled;

    /**
     * Number of requests currently queued for later processing.
     * @var integer
     */
    protected $queueSize;

    /**
     * Number of additional article publish or update requests which could be
     * submitted now before the system will begin throttling.
     * @var integer
     */
    protected $quotaAvailable;

    public function __construct(array $data = [])
    {
        if (isset($data['estimatedDelayInSeconds'])) {
            $this->setEstimatedDelayInSeconds($data['estimatedDelayInSeconds']);
        }

        if (isset($data['isThrottled'])) {
            $this->setIsThrottled($data['isThrottled']);
        }

        if (isset($data['queueSize'])) {
            $this->setQueueSize($data['queueSize']);
        }

        if (isset($data['quotaAvailable'])) {
            $this->setQuotaAvailable($data['quotaAvailable']);
        }
    }

    /**
     * Get the estimatedDelayInSeconds
     * @return integer
     */
    public function getEstimatedDelayInSeconds()
    {
        return $this->estimatedDelayInSeconds;
    }

    /**
     * Set the estimatedDelayInSeconds
     * @param integer $estimatedDelayInSeconds
     * @return $this
     */
    public function setEstimatedDelayInSeconds($estimatedDelayInSeconds)
    {
        Assert::integer($estimatedDelayInSeconds);

        $this->estimatedDelayInSeconds = $estimatedDelayInSeconds;
        return $this;
    }

    /**
     * Get the isThrottled
     * @return boolean
     */
    public function getIsThrottled()
    {
        return $this->isThrottled;
    }

    /**
     * Set the isThrottled
     * @param boolean $isThrottled
     * @return $this
     */
    public function setIsThrottled($isThrottled)
    {
        Assert::boolean($isThrottled);

        $this->isThrottled = $isThrottled;
        return $this;
    }

    /**
     * Get the queueSize
     * @return integer
     */
    public function getQueueSize()
    {
        return $this->queueSize;
    }

    /**
     * Set the queueSize
     * @param integer $queueSize
     * @return $this
     */
    public function setQueueSize($queueSize)
    {
        Assert::integer($queueSize);

        $this->queueSize = $queueSize;
        return $this;
    }

    /**
     * Get the quotaAvailable
     * @return integer
     */
    public function getQuotaAvailable()
    {
        return $this->quotaAvailable;
    }

    /**
     * Set the quotaAvailable
     * @param integer $quotaAvailable
     * @return $this
     */
    public function setQuotaAvailable($quotaAvailable)
    {
        Assert::integer($quotaAvailable);

        $this->quotaAvailable = $quotaAvailable;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        $data = [];
        if (isset($this->estimatedDelayInSeconds)) {
            $data['estimatedDelayInSeconds'] = $this->estimatedDelayInSeconds;
        }
        if (isset($this->isThrottled)) {
            $data['isThrottled'] = $this->isThrottled;
        }
        if (isset($this->queueSize)) {
            $data['queueSize'] = $this->queueSize;
        }
        if (isset($this->quotaAvailable)) {
            $data['quotaAvailable'] = $this->quotaAvailable;
        }
        return $data;
    }
}
