<?php

namespace Urbania\AppleNews\Wordpress;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

class WordpressClient
{
    protected $client;

    public function __construct($baseUri, $opts = [])
    {
        $this->client = new HttpClient(array_merge([
            'base_uri' => rtrim($baseUri, '/')
        ], $opts));
    }

    public function getPosts()
    {
        $response = $this->makeRequest('/wp-json/wp/v2/posts');
        return $response;
    }

    public function getPost($postId)
    {
        $response = $this->makeRequest(sprintf('/wp-json/wp/v2/posts/%s', $postId));
        return $response;
    }

    public function getUsers()
    {
        $response = $this->makeRequest('/wp-json/wp/v2/users');
        return $response;
    }

    public function getUser($userId)
    {
        $response = $this->makeRequest(sprintf('/wp-json/wp/v2/users/%s', $userId));
        return $response;
    }

    public function makeRequest($path, $method = 'GET', $params = [])
    {
        try {
            $response = $this->client->request($method, $path, $method === 'GET' ? [
                'query' => $params,
            ] : [
                'json' => $params,
            ]);
            return new Response($response);
        } catch (ClientException $e) {
            return new Response($e->getResponse());
        } catch (Exception $e) {
            return null;
        }
    }
}
