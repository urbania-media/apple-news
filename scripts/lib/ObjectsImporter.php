<?php

namespace Urbania\AppleNews\Scripts;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\ConsoleOutput;
use GuzzleHttp\Client as HttpClient;
use Symfony\Component\Finder\Finder;
use Urbania\AppleNews\Scripts\Import\AppleDocumentationParser;
use Urbania\AppleNews\Scripts\Import\Document;
use Urbania\AppleNews\Scripts\Import\ObjectDocument;
use StdClass;
use Exception;

class ObjectsImporter
{
    protected $filesystem;
    protected $output;
    protected $client;
    protected $parser;
    protected $importedObjects = [];

    public function __construct($sdk = null)
    {
        $this->filesystem = new Filesystem();
        $this->output = new ConsoleOutput();
        $this->client = new HttpClient();
        $this->parser = new AppleDocumentationParser($sdk);
    }

    public function import($startUrl, $outputPath)
    {
        $state = $this->importDocument($startUrl);
        $objects = $state['objects'];

        $this->output->writeln('<comment>Cleaning:</comment> Existing files...');
        $cleanedFiles = $this->cleanFiles($outputPath);
        $this->output->writeln('<info>Cleaned:</info> ' . sizeof($cleanedFiles) . ' files...');

        $extends = $this->getExtends($objects);
        foreach ($objects as $object) {
            if ($object->isTyped()) {
                $object->setTypedChildClasses($extends[$object->getClassName()]);
            }
            $this->output->writeln(
                '<comment>Writing:</comment> Object ' . $object->getName() . '...'
            );
            $this->writeObject($object, $outputPath);
            $this->output->writeln('<info>Imported:</info> Object ' . $object->getName() . '.');
        }

        return $objects;
    }

    protected function getExtends($objects)
    {
        $extends = [];
        foreach ($objects as $object) {
            $parentClassName = $object->getExtends();
            if (is_null($parentClassName)) {
                continue;
            }
            $extends = $this->addExtends($extends, $parentClassName, $object);
        }

        return $extends;
    }

    protected function addExtends($extends, $parentClassName, $object)
    {
        $className = $object->getClassName();
        if (!isset($extends[$parentClassName])) {
            $extends[$parentClassName] = [];
        }
        $extends[$parentClassName][] = $object;
        $newExtends = $extends;
        foreach ($extends as $parent => $childClasses) {
            if ($parent === $parentClassName) {
                continue;
            }
            $found = array_reduce(
                $childClasses,
                function ($found, $childClass) use ($parentClassName) {
                    return $found || $parentClassName === $childClass->getClassName();
                },
                false
            );
            if ($found) {
                $newExtends = $this->addExtends($newExtends, $parent, $object);
            } elseif ($className === $parent) {
                $newExtends[$parentClassName] = array_values(
                    array_unique(
                        array_merge($newExtends[$parentClassName], $childClasses),
                        SORT_REGULAR
                    )
                );
            }
        }
        return $newExtends;
    }

    protected function importDocument($url, $previousState = null)
    {
        $this->output->writeln('<comment>Fetching:</comment> ' . $url . '...');

        $state = [
            'objects' => data_get($previousState, 'objects', []),
            'urls' => data_get($previousState, 'urls', []),
        ];

        $data = $this->fetchUrl($url);
        $state['urls'][] = $url;

        $document = $this->parser->parse($data, $url);

        if ($document instanceof ObjectDocument) {
            $state['objects'][$document->getName()] = $document;
            $this->output->writeln(
                '<info>Found:</info> Object ' . $document->getName() . ' at ' . $url . '.'
            );
        }

        $links = $document->getLinks();
        unset($document);
        foreach ($links as $link) {
            if (in_array($link, $state['urls'])) {
                continue;
            }
            $state = $this->importDocument($link, $state);
        }

        return $state;
    }

    public function fetchUrl($url)
    {
        try {
            $response = $this->client->get($url);
            return json_decode((string) $response->getBody(), true);
        } catch (Exception $e) {
            return null;
        }
    }

    protected function cleanFiles($path)
    {
        $finder = new Finder();
        $finder->files()->name('*.json')->in($path);
        $files = [];
        foreach ($finder as $file) {
            $files[] = $file->getRealPath();
        }
        $this->filesystem->remove($files);
        return $files;
    }

    protected function writeObject($object, $outputPath)
    {
        $objectPath = $outputPath . '/' . $object->getName() . '.json';
        $content = json_encode($object->toArray(), JSON_PRETTY_PRINT);
        $this->filesystem->dumpFile($objectPath, $content);
        return $objectPath;
    }
}
