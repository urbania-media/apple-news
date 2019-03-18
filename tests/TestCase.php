<?php

use PHPUnit\Framework\TestCase as BaseTestCase;
use Dotenv\Dotenv;

class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $dotenv = new Dotenv(realpath(__DIR__.'/../'));
        $dotenv->load();
        $dotenv->required(['APPLE_NEWS_API_KEY', 'APPLE_NEWS_API_SECRET', 'APPLE_NEWS_CHANNEL_ID']);
    }
}
