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

    public function getComponent()
    {
        $title = new Title([
            'text' => $this->title,
            'anchor' => new Anchor([
                'targetAnchorPosition' => 'bottom',
                'originAnchorPosition' => 'bottom'
            ]),
            'textStyle' => [
                'textColor' => '#fff',
                'fontSize' => 40
            ],
            'layout' => [
                'contentInset' => [
                    'top' => true,
                    'bottom' => true
                ]
            ]
        ]);

        $imageFill = !is_null($this->image) ? new ImageFill([
            'URL' => $this->image
        ]) : null;

        return new HeaderComponent([
            'components' => [
                $title,
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
