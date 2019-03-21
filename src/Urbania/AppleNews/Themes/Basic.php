<?php

namespace Urbania\AppleNews\Themes;

use Urbania\AppleNews\Support\Theme;

class Basic extends Theme
{
    public function getLayout()
    {
        return [
            'columns' => 12,
            'width' => 1024
        ];
    }

    public function getComponentLayouts()
    {
        return [
            'paragraph' => [
                'margin' => [
                    'bottom' => 20
                ]
            ]
        ];
    }

    public function getComponentTextStyles()
    {
        return [
            'header_title' => [
                'fontSize' => 40,
                'textColor' => '#fff'
            ]
        ];
    }

    public function getComponentRules()
    {
        return [
            [
                'selector' => '#header_title',
                'rules' => [
                    'textStyle' => 'header_title'
                ]
            ],
            [
                'selector' => 'body',
                'rules' => [
                    'layout' => 'paragraph'
                ]
            ]
        ];
    }
}
