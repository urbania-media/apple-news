<?php

namespace Urbania\AppleNews\Scripts;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;
use Urbania\AppleNews\Scripts\Builder\ObjectFileBuilder;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;

class ObjectsGenerator
{
    use ClassUtils;

    protected $filesystem;

    protected $objectFileBuilder;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->objectFileBuilder = new ObjectFileBuilder();
    }

    public function generate($objectsPath, $outputPath)
    {
        $objects = $this->getObjectsFromPath($objectsPath);
        $files = $this->buildFiles($objects);
        $paths = $this->writeFiles($files, $outputPath);
        return $paths;
    }

    protected function buildFiles(array $objects)
    {
        return array_map(function ($object) {
            return $this->objectFileBuilder->build($object);
        }, $objects);
    }

    protected function writeFiles($files, $outputPath)
    {
        return array_map(function ($file) use ($outputPath) {
            return $this->writeFile($file, $outputPath);
        }, $files);
    }

    protected function writeFile(PhpFile $file, $outputPath)
    {
        $namespaces = $file->getNamespaces();
        $namespace = array_keys($namespaces)[0];
        $classes = $namespaces[$namespace]->getClasses();
        $className = array_keys($classes)[0];
        $namespacePath = preg_replace('/^'.preg_quote($this->getBaseNamespace(), '/').'?(.*)$/', '$1', $namespace);
        $namespacePath = !empty($namespacePath) ? str_replace('\\', '/', $namespacePath).'/' : '';

        $printer = new PsrPrinter();
        $classPath = $outputPath.'/'.$namespacePath.$className.'.php';
        $content = $printer->printFile($file);
        $this->filesystem->dumpFile($classPath, $content);
        $this->prettyFile($classPath);
        return $classPath;
    }

    protected function prettyFile($path)
    {
        $command = [
            realpath(__DIR__ . '/../../node_modules/.bin/prettier'),
            '--write',
            $path
        ];
        shell_exec(escapeshellcmd(implode(' ', $command)));
    }

    protected function getObjectsFromPath($path)
    {
        $finder = $this->getObjectsFinder($path);

        $objects = [];
        foreach ($finder as $file) {
            $objects[] = json_decode($file->getContents(), true);
        }

        return $objects;
    }

    protected function getObjectsFinder($path)
    {
        $finder = new Finder();
        $finder->files()->in($path);
        return $finder;
    }
}
