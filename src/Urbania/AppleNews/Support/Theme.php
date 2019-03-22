<?php

namespace Urbania\AppleNews\Support;

use Urbania\AppleNews\Contracts\Theme as ThemeContract;
use Urbania\AppleNews\Article;

class Theme implements ThemeContract
{
    public function getLayout()
    {
        return null;
    }

    public function getDocumentStyle()
    {
        return null;
    }

    public function getTextStyles()
    {
        return null;
    }

    public function getComponentTextStyles()
    {
        return null;
    }

    public function getComponentLayouts()
    {
        return null;
    }

    public function getComponentStyles()
    {
        return null;
    }

    public function getComponentRules()
    {
        return [];
    }

    public function apply($article)
    {
        $themeArticle = new Article([
            'layout' => $this->getLayout(),
            'documentStyle' => $this->getDocumentStyle(),
            'textStyles' => $this->getTextStyles(),
            'componentTextStyles' => $this->getComponentTextStyles(),
            'componentLayouts' => $this->getComponentLayouts(),
            'componentStyles' => $this->getComponentStyles(),
        ]);

        $articleWithTheme = new Article(clone $article);
        $articleWithTheme = $articleWithTheme->merge($themeArticle);

        $rules = $this->getComponentRules();
        $this->applyRulesToComponents($rules, $articleWithTheme->components);

        return $articleWithTheme;
    }

    protected function applyRulesToComponents($rules, $components)
    {
        $finder = new ComponentsFinder();
        foreach ($rules as $rule) {
            $selector = $rule['selector'];
            $foundComponents = $finder->find($selector, $components);
            foreach ($foundComponents as $component) {
                $this->applyRulesToComponent($component, $rule['rules']);
            }
        }
    }

    protected function applyRulesToComponent($component, $rules)
    {
        $component->merge($rules);
    }
}
