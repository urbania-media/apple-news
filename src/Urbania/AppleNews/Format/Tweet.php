<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding a Tweet that was posted to Twitter.
 *
 * @see https://developer.apple.com/documentation/apple_news/tweet
 */
class Tweet extends Component
{
    /**
     * The URL of the tweet you want to embed.
     * @var uri
     */
    protected $URL;

    /**
     * This component always has a role of tweet.
     * @var string
     */
    protected $role = 'tweet';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
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
     * Get the URL
     * @return uri
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the URL
     * @param uri $URL
     * @return $this
     */
    public function setURL($URL)
    {
        Assert::uri($URL);

        $this->URL = $URL;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'URL' => $this->URL,
            'role' => $this->role
        ]);
    }
}
