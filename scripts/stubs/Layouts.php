<?php

class Layouts
{
    public function __construct(array $data = [])
    {
        $this->setLayouts($data);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $layouts = [];
        foreach ($this->layouts as $key => $layout) {
            $layouts[$key] = !is_null($layout) ? $layout->toArray() : null;
        }
        return $layouts;
    }
}
