<?php

namespace Urbania\AppleNews\Support;

use Urbania\AppleNews\Contracts\Theme as ThemeContract;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Format\ArticleDocument;
use Closure;

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

    public function getFonts()
    {
        return [];
    }

    public function apply($article)
    {
        $themeDocument = [
            'layout' => $this->getLayout(),
            'documentStyle' => $this->getDocumentStyle(),
            'textStyles' => $this->getTextStyles(),
            'componentTextStyles' => $this->getComponentTextStyles(),
            'componentLayouts' => $this->getComponentLayouts(),
            'componentStyles' => $this->getComponentStyles(),
        ];

        if ($article instanceof Article) {
            $themeArticle = new Article($themeDocument);
            $this->applyFonts($themeArticle);
        } else {
            $themeArticle = new ArticleDocument($themeDocument);
        }

        $articleWithTheme = with(clone $article)->merge($themeArticle);

        $rules = $this->getComponentRules();
        $this->applyRulesToComponents($rules, $articleWithTheme->components);

        return $articleWithTheme;
    }

    public function applyFonts(Article $article)
    {
        return $article->setFonts($this->getFonts());
    }

    protected function applyRulesToComponents($rules, $components)
    {
        $finder = new ComponentsFinder();
        foreach ($rules as $rule) {
            $selector = $rule['selector'];
            $foundComponents = $finder->find($selector, $components);
            if (isset($rule['rules'])) {
                foreach ($foundComponents as $component) {
                    $this->applyRulesToComponent($component, $rule);
                }
            }
            if (isset($rule['transform'])) {
                $transform = $rule['transform'];
                $transform($foundComponents, $rule);
            }
        }
    }

    protected function applyRulesToComponent($component, $rule)
    {
        $rules = $rule['rules'];
        if ($rules instanceof Closure) {
            $rules = $rules($component, $rule);
        }
        $component->merge($rules);
    }
}
