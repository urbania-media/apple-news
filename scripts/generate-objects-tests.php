#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Urbania\AppleNews\Scripts\ObjectsTestsGenerator;

$objectsPath = realpath(__DIR__ . '/../src/objects');
$outputPath = realpath(__DIR__ . '/../tests');

$objectsGenerator = new ObjectsTestsGenerator();
$objectsGenerator->generate($objectsPath, $outputPath);
