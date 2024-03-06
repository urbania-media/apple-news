#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Urbania\AppleNews\Scripts\ObjectsImporter;

$startUrl = 'https://developer.apple.com/tutorials/data/documentation/apple_news/apple_news_format.json';
$outputPath = realpath(__DIR__ . '/../src/objects/format');

$objectsImporter = new ObjectsImporter();
$objectsImporter->import($startUrl, $outputPath);
