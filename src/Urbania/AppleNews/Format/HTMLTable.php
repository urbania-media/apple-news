<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding tables with HTML data.
 *
 * @see https://developer.apple.com/documentation/apple_news/htmltable
 */
class HTMLTable extends Component
{
    /**
     * The HTML for the table. This HTML must begin with <table> and end with
     * </table>.
     * @var string
     */
    protected $html;

    /**
     * This component always has a role of htmltable.
     * @var string
     */
    protected $role = 'htmltable';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['html'])) {
            $this->setHtml($data['html']);
        }
    }

    /**
     * Get the html
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
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
     * Set the html
     * @param string $html
     * @return $this
     */
    public function setHtml($html)
    {
        Assert::string($html);

        $this->html = $html;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'html' => $this->html,
            'role' => $this->role
        ]);
    }
}
