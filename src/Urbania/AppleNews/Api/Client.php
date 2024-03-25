<?php

namespace Urbania\AppleNews\Api;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\ClientException;
use Exception;
use Illuminate\Support\Facades\Log;

class Client
{
    protected $options;
    protected $key;
    protected $handler;
    protected $client;
    protected $hmacMiddleware;

    public function __construct($apiKey, $apiSecret, $opts = [])
    {
        $this->options = array_merge(
            [
                'base_uri' => 'https://news-api.apple.com',
                'middlewares' => [],
                'debug' => false,
            ],
            $opts
        );
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
        $debug = data_get($this->options, 'debug', false);
        try {
            $response = $this->client->request(
                $method,
                $path,
                $method === 'GET'
                    ? [
                        'query' => $params,
                    ]
                    : [
                        'multipart' => $params,
                    ]
            );
            return new Response($response);
        } catch (ClientException $e) {
            if ($debug) {
                Log::error($e);
            }
            return new Response($e->getResponse());
        } catch (Exception $e) {
            if ($debug) {
                Log::error($e);
            }
            return null;
        }
    }
}
