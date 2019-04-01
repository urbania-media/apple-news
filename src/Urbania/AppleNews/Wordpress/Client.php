<?php

namespace Urbania\AppleNews\Wordpress;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

class Client
{
    protected $client;

    public function __construct($baseUri, $opts = [])
    {
        $this->client = new HttpClient(array_merge([
            'base_uri' => rtrim($baseUri, '/').'/'
        ], $opts));
    }

    public function getPosts($query = [], $page = 1, $count = 10)
    {
        $params = array_merge([
            'page' => $page,
            'per_page' => $count
        ], $query);
        $response = $this->makeRequest('wp/v2/posts', 'GET', $params);
        return $response;
    }

    public function getPost($postId)
    {
        $response = $this->makeRequest(sprintf('wp/v2/posts/%s', $postId));
        return $response;
    }

    public function getCategories($query = [], $page = 1, $count = 10)
    {
        $params = array_merge([
            'page' => $page,
            'per_page' => $count
        ], $query);
        $response = $this->makeRequest('wp/v2/categories', 'GET', $params);
        return $response;
    }

    public function getCategory($categoryId)
    {
        $response = $this->makeRequest(sprintf('wp/v2/categories/%s', $categoryId));
        return $response;
    }

    public function getMedias($query = [], $page = 1, $count = 10)
    {
        $params = array_merge([
            'page' => $page,
            'per_page' => $count
        ], $query);
        $response = $this->makeRequest('wp/v2/media', 'GET', $params);
        return $response;
    }

    public function getMedia($mediaId)
    {
        $response = $this->makeRequest(sprintf('wp/v2/media/%s', $mediaId));
        return $response;
    }

    public function getUsers($query = [], $page = 1, $count = 10)
    {
        $params = array_merge([
            'page' => $page,
            'per_page' => $count
        ], $query);
        $response = $this->makeRequest('wp/v2/users', 'GET', $params);
        return $response;
    }

    public function getUser($userId)
    {
        $response = $this->makeRequest(sprintf('wp/v2/users/%s', $userId));
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
            return new Response($response, $params);
        } catch (ClientException $e) {
            return new Response($e->getResponse(), $params);
        } catch (Exception $e) {
            return null;
        }
    }
}
