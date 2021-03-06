<?php

namespace Urbania\AppleNews\Scripts\Import;

class ApiObjectDocument extends ObjectDocument
{
    protected $versionPattern = '/Apple News API ([0-9]+\.[0-9]+\.[0-9]+\+?)/';
    protected $namespace = 'Api\\Objects';

    public function getProperties()
    {
        $properties = parent::getProperties();
        if ($this->hasMultipleInherits()) {
            $inherits = array_slice($this->getInherits(), 1);
            foreach ($inherits as $inherit) {
                if (preg_match('/(Links|Meta)$/', $inherit, $matches)) {
                    $properties[] = [
                        'name' => strtolower($matches[1]),
                        'type' => $this->getType($inherit)
                    ];
                }
            }
        }
        if ($this->getName() === 'Article') {
            $properties = array_map(function ($property) {
                if ($property['name'] === 'document') {
                    $property['type'] = ['Format\\ArticleDocument', $property['type']];
                }
                return $property;
            }, $properties);
        }
        return $properties;
    }
}
