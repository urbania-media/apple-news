<?php

namespace Urbania\AppleNews\Components;

use Urbania\AppleNews\Support\Component;
use Urbania\AppleNews\Format\Header as HeaderComponent;
use Urbania\AppleNews\Format\Title;
use Urbania\AppleNews\Format\Anchor;
use Urbania\AppleNews\Format\ImageFill;

class Header extends Component
{
    protected $title;

    protected $image;

    public function __construct($title, $image = null)
    {
        $this->title = $title;
        $this->image = $image;
    }

    protected function getTitleComponent()
    {
        return new Title([
            'identifier' => 'header_title',
            'text' => $this->title,
            'anchor' => new Anchor([
                'targetAnchorPosition' => 'bottom',
                'originAnchorPosition' => 'bottom'
            ]),
            'layout' => [
                'contentInset' => [
                    'top' => true,
                    'bottom' => true
                ]
            ]
        ]);
    }

    public function toComponent()
    {
        $imageFill = !is_null($this->image) ? new ImageFill([
            'URL' => $this->image
        ]) : null;

        return new HeaderComponent([
            'identifier' => 'header',
            'components' => [
                $this->getTitleComponent(),
            ],
            'layout' => [
                'minimumHeight' => '50vh',
                'ignoreDocumentMargin' => true,
                'ignoreDocumentGutter' => true,
                'margin' => [
                    'bottom' => 40
                ]
            ],
            'style' => [
                'fill' => $imageFill
            ]
        ]);
    }
}
