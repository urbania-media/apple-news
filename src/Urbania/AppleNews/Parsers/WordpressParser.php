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

    protected $options = [
        'url' => null,
        'urlPattern' => null,
    ];

    protected $articleDefaults = [
        'language' => 'fr-CA',
        'version' => '1.7',
        'layout' => [
            'columns' => 7,
            'width' => 1024
        ],
        'componentLayouts' => [
            'paragraph' => [
                'margin' => [
                    'bottom' => 20
                ]
            ]
        ]
    ];

    public function __construct($opts = [], $defaults = [])
    {
        $this->options = array_merge($this->options, is_array($opts) ? $opts : [
            'url' => is_string($opts) ? $opts : null,
        ]);
        $this->client = !is_null($this->options['url'])
            ? new WordpressClient($this->options['url'])
            : null;
        $this->htmlParser = new HtmlParser();
        $this->articleDefaults = array_merge($this->articleDefaults, $defaults);
    }

    public function parse($post, $defaults = [])
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

        $content = $post['content'] ?? null;
        $html = !is_null($content) ? $content['rendered'] ?? null : null;
        $htmlArticle = $this->htmlParser->parse($html);

        $title = html_entity_decode($post['title']['rendered'], ENT_QUOTES, 'utf-8');

        $article = new Article(array_merge($this->articleDefaults, $defaults, [
            'title' => $title,
            'identifier' => 'wordpress-'.$post['id'],
            'components' => [
                $this->getHeaderComponent($title, $featuredMedia)
            ],
        ]));
        $article->mergeDocument($htmlArticle);

        return $article;
    }

    protected function getPostIdFromUrl($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query']) && preg_match('/^(.*&)?p=([0-9]+)(\&.*)?$/', $parsedUrl['query'], $matches)) {
            return $matches[2];
        } elseif (isset($this->options['urlPattern']) && preg_match($this->options['urlPattern'], $url, $matches)) {
            return $matches['postId'];
        }
        return null;
    }

    protected function getHeaderComponent($title, $featuredMedia)
    {
        return new Header($title, $featuredMedia->source_url);
    }
}
