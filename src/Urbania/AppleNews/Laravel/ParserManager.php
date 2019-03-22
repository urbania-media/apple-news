<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Closure;
use InvalidArgumentException;
use Urbania\AppleNews\Contracts\Article as ArticleContract;
use Urbania\AppleNews\Parsers\HTMLParser;
use Urbania\AppleNews\Parsers\WordpressParser;

class ParserManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * The array of created "parsers".
     *
     * @var array
     */
    protected $parsers = [];

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the default parser name.
     *
     * @return string
     */
    public function getDefaultParser()
    {
        return $this->app['config']->get('apple-news.parser');
    }

    /**
     * Create the wordpress driver
     *
     * @param  array  $config
     * @return \Urbania\AppleNews\Contracts\Parser
     */
    protected function createWordpressDriver($config)
    {
        return new WordpressParser($config);
    }

    /**
     * Create the html driver
     *
     * @param  array  $config
     * @return \Urbania\AppleNews\Contracts\Parser
     */
    protected function createHtmlDriver($config)
    {
        return new HtmlParser($config);
    }

    /**
     * Get a parser instance.
     *
     * @param  string  $parser
     * @return \App\Contracts\Dialog\Service
     *
     * @throws \InvalidArgumentException
     */
    public function parser($parser = null)
    {
        $parser = isset($parser) ? $parser : $this->getDefaultParser();

        if (is_null($parser)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Unable to resolve NULL driver for [%s].',
                    static::class
                )
            );
        }

        // If the given driver has not been created before, we will create the instances
        // here and cache it so we can return it next time very quickly. If there is
        // already a driver created by this name, we'll just return that instance.
        if (!isset($this->parsers[$parser])) {
            $this->parsers[$parser] = $this->createParser($parser);
        }

        return $this->parsers[$parser];
    }

    /**
     * Create a new parser instance.
     *
     * @param  string  $parser
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    protected function createParser($parser)
    {
        $config = $this->getConfig($parser);
        $driver = $config['driver'];

        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver, $config, $parser);
        } else {
            $method = 'create' . Str::studly($driver) . 'Driver';

            if (method_exists($this, $method)) {
                return $this->$method($config, $parser);
            }
        }
        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string  $driver
     * @param  array  $config
     * @param  string  $parser
     * @return mixed
     */
    protected function callCustomCreator($driver, $config, $parser)
    {
        return $this->customCreators[$driver]($this->app, $config, $parser);
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string    $driver
     * @param  \Closure  $callback
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * Get all of the created "parsers".
     *
     * @return array
     */
    public function getParsers()
    {
        return $this->parsers;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->parser()->$method(...$parameters);
    }

    /**
     * Get the article defaults
     *
     * @return string
     */
    protected function getDefaultArticle()
    {
        return value($this->app['config']->get('apple-news.article', []));
    }

    /**
     * Get the dialog parser configuration.
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig($name)
    {
        if (!is_null($name) && $name !== 'null') {
            $config = $this->app['config']->get(
                "apple-news.parsers.{$name}",
                []
            );

            $defaultArticle = $this->getDefaultArticle();
            $configArticle = value(isset($config['article']) ? $config['article'] : []);
            if ($defaultArticle instanceof ArticleContract) {
                $config['article'] = $defaultArticle->merge($configArticle);
            } elseif ($configArticle instanceof ArticleContract) {
                $config['article'] = $this->app->make(ArticleContract::class)->merge($configArticle);
            } else {
                $config['article'] = array_merge($defaultArticle, $configArticle);
            }

            return $config;
        }

        return [
            'driver' => 'null',
            'article' => $this->getDefaultArticle()
        ];
    }
}
