#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Urbania\AppleNews\Scripts\ObjectsGenerator;

$objectsPath = realpath(__DIR__ . '/../src/objects');
$outputPath = realpath(__DIR__ . '/../src/Urbania/AppleNews');

$objectsGenerator = new ObjectsGenerator();
$objectsGenerator->generate($objectsPath, $outputPath);
