<?php

namespace Urbania\AppleNews\Api;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\ClientException;
use Exception;

class Client
{
    protected $options;
    protected $key;
    protected $handler;
    protected $client;

    public function __construct($apiKey, $apiSecret, $opts = [])
    {
        $this->options = array_merge([
            'base_uri' => 'https://news-api.apple.com',
            'middlewares' => [],
        ], $opts);
        $this->hmacMiddleware = $this->createHmacMiddleware($apiKey, $apiSecret);
        $this->handler = $this->createHandlerStack($this->hmacMiddleware);
        $this->client = $this->createClient($this->handler);
    }

    protected function createHmacMiddleware($apiKey, $apiSecret)
    {
        $middleware = new HMACMiddleware($apiKey, $apiSecret);
        return $middleware;
    }

    protected function createHandlerStack($hmacMiddleware)
    {
        $middlewares = $this->options['middlewares'];
        $handler = HandlerStack::create();
        $handler->push($hmacMiddleware);
        foreach ($middlewares as $middleware) {
            $handler->push($middleware);
        }
        return $handler;
    }

    protected function createClient($handler)
    {
        $client = new HttpClient([
            'handler' => $handler,
            'base_uri' => $this->options['base_uri'],
        ]);
        return $client;
    }

    public function makeRequest($path, $method = 'GET', $params = [])
    {
        try {
            $response = $this->client->request($method, $path, $method === 'GET' ? [
                'query' => $params,
            ] : [
                'multipart' => $params,
            ]);
            $data = json_decode((string)$response->getBody(), true);
            return $data['data'];
        } catch (ClientException $e) {
            dd($e);
            return null;
        } catch (Exception $e) {
            dd($e);
            return null;
        }
    }

    public function channels($channelId = null)
    {
        return new ChannelsClient($this, $channelId);
    }
}
