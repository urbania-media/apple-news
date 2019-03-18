<?php

namespace Urbania\AppleNews\Scripts;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Finder\Finder;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;
use Urbania\AppleNews\Scripts\Builder\ObjectFileBuilder;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;

class ObjectsGenerator
{
    use ClassUtils;

    protected $filesystem;

    protected $output;

    protected $objectFileBuilder;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->output = new ConsoleOutput();
        $this->objectFileBuilder = new ObjectFileBuilder();
    }

    public function generate($objectsPath, $outputPath)
    {
        $this->output->writeLn('<comment>Finding:</comment> Objects from path '.$objectsPath.'...');
        $objects = $this->getObjectsFromPath($objectsPath);
        $this->output->writeLn('<info>Found:</info> '.sizeof($objects).' objects in path '.$objectsPath.'.');
        $files = $this->buildFiles($objects);
        $paths = $this->writeFiles($files, $outputPath);
        return $paths;
    }

    protected function buildFiles(array $objects)
    {
        return array_map(function ($object) {
            $this->output->writeLn('<comment>Building:</comment> Object '.$object['name'].'...');
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
        $classPath = $outputPath.'/'.trim($namespacePath, '/').'/'.$className.'.php';

        $this->output->writeLn('<comment>Writing:</comment> Class '.$className.' to '.$classPath.'...');
        $printer = new PsrPrinter();
        $content = $printer->printFile($file);
        $this->filesystem->dumpFile($classPath, $content);
        $this->output->writeLn('<comment>Prettying:</comment> '.$classPath.'...');
        $this->prettyFile($classPath);
        $this->output->writeLn('<info>Writed:</info> Class '.$className.' to '.$classPath.'.');
        return $classPath;
    }

    protected function prettyFile($path)
    {
        $this->output->writeLn('<comment>Executing:</comment> prettier on '.$path.'...');
        $command = [
            realpath(__DIR__ . '/../../node_modules/.bin/prettier'),
            '--write',
            $path
        ];
        $output = shell_exec(escapeshellcmd(implode(' ', $command)));
        if (!empty($output)) {
            $this->output->write(PHP_EOL.$output.PHP_EOL.'---'.PHP_EOL);
        }

        $this->output->writeLn('<comment>Executing:</comment> phpcbf on '.$path.'...');
        $command = [
            realpath(__DIR__ . '/../../vendor/bin/phpcbf'),
            $path
        ];
        $output = shell_exec(escapeshellcmd(implode(' ', $command)));
        if (!empty($output)) {
            $this->output->write(PHP_EOL.$output.PHP_EOL.'---'.PHP_EOL);
        }
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
