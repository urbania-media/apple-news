<?php

namespace Urbania\AppleNews\Support\Concerns;

use Symfony\Component\Filesystem\Filesystem;

trait UsesFilesystem
{
    protected $filesystem;

    public function getFilesystem()
    {
        if (!$this->filesystem) {
            $this->filesystem = new Filesystem();
        }
        return $this->filesystem;
    }
}
