<?php

namespace Urbania\AppleNews\Scripts;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Finder\Finder;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;
use Urbania\AppleNews\Scripts\Builder\ObjectTestFileBuilder;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;

class ObjectsTestsGenerator extends ObjectsGenerator
{
    public function __construct()
    {
        parent::__construct();
        $this->objectFileBuilder = new ObjectTestFileBuilder();
    }

    protected function getClassPathFromFile(PhpFile $file)
    {
        $className = $this->getClassNameFromFile($file);
        $namespace = $this->getNamespaceFromFile($file);
        $namespacePath = preg_replace('/^'.preg_quote($this->getTestsBaseNamespace(), '/').'?(.*)$/', '$1', $namespace);
        $namespacePath = !empty($namespacePath) ? str_replace('\\', '/', $namespacePath).'/' : '';
        return trim($namespacePath, '/').'/'.$className.'.php';
    }
}
