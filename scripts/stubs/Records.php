<?php

class Records
{
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
