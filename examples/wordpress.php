#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Urbania\AppleNews\Article;
use Urbania\AppleNews\Parsers\WordpressParser;
use Urbania\AppleNews\Themes\Basic as BasicTheme;

$parser = new WordpressParser([
    'url' => 'https://urbania.ca/wp-json/',
    'postUrlPattern' => '#https://urbania.ca/(?<postId>[0-9]+)/([^/]+)/?#'
]);
$article = $parser->parse(
    'https://urbania.ca/305590/trois-villes-se-disputent-le-1er-rang-de-la-plus-chere-au-monde/'
);

$theme = new BasicTheme();
$articleWithTheme = $theme->apply($article);
$articleWithTheme->saveJsonToFile(__DIR__ . '/article.json', JSON_PRETTY_PRINT);

dd($articleWithTheme->toArray());
