<?php

namespace Urbania\AppleNews\Support;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Urbania\AppleNews\Article;

abstract class JsonParser extends Parser
{
    protected $client;
    protected $htmlParser;

    protected $article = [];

    public function __construct($opts = [])
    {
        $this->setOptions($opts);

        $this->client = new HttpClient();
    }

    public function setOptions(array $opts)
    {
        if (isset($opts['article'])) {
            $this->article = $opts['article'];
        }
    }

    public function fetchJson($url, $method = 'GET', $opts = [])
    {
        try {
            $response = $this->client->request($method, $url, $opts);
            return json_decode((string)$response->getBody(), true);
        } catch (ClientException $e) {
            return null;
        } catch (Exception $e) {
            return null;
        }
    }
}
