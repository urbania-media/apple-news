<?php

namespace Urbania\AppleNews\Parsers;

use Urbania\AppleNews\Wordpress\WordpressClient;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Components\Header;
use Urbania\AppleNews\Support\Parser;

class WordpressParser extends Parser
{
    protected $client;
    protected $htmlParser;

    protected $article = [
        'componentLayouts' => [
            'paragraph' => [
                'margin' => [
                    'bottom' => 20
                ]
            ]
        ]
    ];

    protected $url;

    protected $postUrlPattern;

    public function __construct($opts = [])
    {
        if (is_string($opts)) {
            $this->url = $opts;
        } else {
            $this->setOptions($opts);
        }

        $this->client = !is_null($this->url)
            ? new WordpressClient($this->url)
            : null;
        $this->htmlParser = new HtmlParser();
    }

    public function setOptions(array $opts)
    {
        if (isset($opts['url'])) {
            $this->url = $opts['url'];
        }
        if (isset($opts['postUrlPattern'])) {
            $this->postUrlPattern = $opts['postUrlPattern'];
        }
        if (isset($opts['article'])) {
            $this->article = $opts['article'];
        }
    }

    public function parse($post, $article = null)
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

        $featuredMediaId = $post['featured_media'] ?? null;
        $featuredMedia = !is_null($featuredMediaId) ? $this->client->getMedia($featuredMediaId) : null;

        $title = html_entity_decode($post['title']['rendered'], ENT_QUOTES, 'utf-8');

        $data = [
            'title' => $title,
            'identifier' => 'wordpress-'.$post['id'],
            'components' => [
                $this->getHeaderComponent($title, $featuredMedia)
            ],
        ];

        $parsedArticle = new Article($this->article);
        if (!is_null($article)) {
            $parsedArticle->merge($article);
        }
        $parsedArticle->merge($data);

        $content = $post['content'] ?? null;
        $html = !is_null($content) ? $content['rendered'] ?? null : null;
        $parsedArticle = $this->htmlParser->parse($html, $parsedArticle);

        return $parsedArticle;
    }

    protected function getPostIdFromUrl($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query']) && preg_match('/^(.*&)?p=([0-9]+)(\&.*)?$/', $parsedUrl['query'], $matches)) {
            return $matches[2];
        } elseif (isset($this->postUrlPattern) && preg_match($this->postUrlPattern, $url, $matches)) {
            return $matches['postId'];
        }
        return null;
    }

    protected function getHeaderComponent($title, $featuredMedia)
    {
        return new Header($title, $featuredMedia->source_url);
    }
}
