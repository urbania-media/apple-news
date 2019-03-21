<?php

namespace Urbania\AppleNews\Support\Concerns;

use Symfony\Component\Filesystem\Filesystem;

trait SaveJsonToFile
{
    use UsesFilesystem;

    /**
     * Save the Json to a file
     * @return array The multipart body
     */
    public function saveJsonToFile($path, $options = 0)
    {
        $json = $this->toJson($options);
        $filesystem = $this->getFilesystem();
        $filesystem->dumpFile($path, $json);
    }
}
