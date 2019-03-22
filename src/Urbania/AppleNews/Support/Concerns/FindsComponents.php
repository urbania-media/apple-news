<?php

namespace Urbania\AppleNews\Support\Concerns;

use Urbania\AppleNews\Support\ComponentsFinder;

trait FindsComponents
{
    private $componentsFinder;

    protected function getComponentsFinder()
    {
        if (!$this->componentsFinder) {
            $this->componentsFinder = new ComponentsFinder();
        }
        return $this->componentsFinder;
    }

    public function findComponents($selector, $components = null)
    {
        if (is_null($components)) {
            $components = $this->components;
        }

        $finder = $this->getComponentsFinder();
        return $finder->find($selector, $components);
    }
}
