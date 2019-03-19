<?php

namespace Urbania\AppleNews\Parsers;

use Urbania\AppleNews\Wordpress\WordpressClient;

class WordpressParser extends Parser
{
    protected $client;
    protected $htmlParser;

    public function __construct($baseUri = null)
    {
        $this->client = !is_null($baseUri)
            ? new WordpressClient($baseUri)
            : null;
        $this->htmlParser = new HtmlParser();
    }

    public function parse($post)
    {
        if (is_numeric($post)) {
            $post = $this->client->getPost($post);
        } elseif (filter_var($post, FILTER_VALIDATE_URL)) {
            $postId = $this->getPostIdFromUrl($post);
            $post = !is_null($postId) ? $this->client->getPost($postId) : null;
        }

        if (is_null($post)) {
            return null;
        }

        $content = $post['content'] ?? null;
        $html = !is_null($content) ? $content['rendered'] ?? null : null;
        $article = $this->htmlParser->parse($html);
        $article->title = $post['title']['rendered'];
        $article->identifier = 'wordpress-'.$post['id'];
        $article->language = 'fr-CA';
        $article->version = '1.7';
        $article->layout = [
            'columns' => 12,
            'width' => 600
        ];
        return $article;
    }

    protected function getPostIdFromUrl($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query']) && preg_match('/^(.*&)?p=([0-9]+)(\&.*)?$/', $parsedUrl['query'], $matches)) {
            return $matches[2];
        }
        return null;
    }
}
