#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Urbania\AppleNews\Api;

$dotenv = new Dotenv(realpath(__DIR__.'/../'));
$dotenv->load();
$dotenv->required(['APPLE_NEWS_API_KEY', 'APPLE_NEWS_API_SECRET', 'APPLE_NEWS_CHANNEL_ID']);

$apiKey = getenv('APPLE_NEWS_API_KEY');
$apiSecret = getenv('APPLE_NEWS_API_SECRET');
$channelId = getenv('APPLE_NEWS_CHANNEL_ID');
$client = new Api($apiKey, $apiSecret);
$channelsClient = $client->channels($channelId);

$articles = $channelsClient->searchArticles();

dd($articles);
