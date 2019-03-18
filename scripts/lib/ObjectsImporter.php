<?php

namespace Urbania\AppleNews\Scripts;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\ConsoleOutput;
use GuzzleHttp\Client as HttpClient;
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
        $state = $this->importDocument($startUrl, $outputPath);
        return $state;
    }

    protected function importDocument($url, $outputPath, $state = null)
    {
        $this->output->writeln('<comment>Fetching:</comment> '.$url.'...');

        if (is_null($state)) {
            $state = new StdClass();
            $state->objects = [];
            $state->urls = [];
        }

        $html = $this->fetchUrl($url);
        $state->urls[] = $url;

        $document = $this->parser->parse($html, $url);

        if ($document instanceof ObjectDocument) {
            $this->output->writeln('<comment>Writing:</comment> Object '.$document->getName().' from '.$url.'...');
            $state->objects[$document->getName()] = $this->writeObject($document, $outputPath);
            $this->output->writeln('<info>Imported:</info> Object '.$document->getName().' from '.$url.'.');
        }

        $links = $document->getLinks();
        foreach ($links as $link) {
            if (in_array($link, $state->urls)) {
                continue;
            }
            $state = $this->importDocument($link, $outputPath, $state);
        }

        return $state;
    }

    public function fetchUrl($url)
    {
        try {
            $response = $this->client->get($url);
            return (string)$response->getBody();
        } catch (Exception $e) {
            return null;
        }
    }

    protected function writeObject($object, $outputPath)
    {
        $objectPath = $outputPath.'/'.$object->getName().'.json';
        $content = json_encode($object->toArray(), JSON_PRETTY_PRINT);
        $this->filesystem->dumpFile($objectPath, $content);
        return $objectPath;
    }
}
