#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Urbania\AppleNews\Scripts\ObjectsImporter;
use Urbania\AppleNews\Scripts\Import\AppleDocumentationParser;

$startUrl = 'https://developer.apple.com/tutorials/data/documentation/apple_news/apple_news_api.json';
$outputPath = realpath(__DIR__ . '/../src/objects/api');

$objectsImporter = new ObjectsImporter(AppleDocumentationParser::APPLE_NEWS_API);
$objectsImporter->import($startUrl, $outputPath);
