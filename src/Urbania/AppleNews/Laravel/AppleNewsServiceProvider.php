<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class AppleNewsServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected function getRouter()
    {
        return $this->app['router'];
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootPublishes();
    }

    public function bootPublishes()
    {
        // Config file path
        $configPath = __DIR__ . '/config.php';

        // Merge files
        $this->mergeConfigFrom($configPath, 'apple-news');

        // Publish
        $this->publishes(
            [
                $configPath => config_path('apple-news.php'),
            ],
            'config'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerApi();

        $this->registerArticle();

        $this->registerParserManager();

        $this->registerAppleNews();
    }

    public function registerApi()
    {
        $this->app
            ->when(\Urbania\AppleNews\Laravel\Api::class)
            ->needs('$apiKey')
            ->give(function () {
                return $this->app['config']->get(
                    'apple-news.api_key',
                    $this->app['config']->get('services.apple_news.key')
                );
            });

        $this->app
            ->when(\Urbania\AppleNews\Laravel\Api::class)
            ->needs('$apiSecret')
            ->give(function () {
                return $this->app['config']->get(
                    'apple-news.api_secret',
                    $this->app['config']->get('services.apple_news.secret')
                );
            });

        $this->app
            ->when(\Urbania\AppleNews\Laravel\Api::class)
            ->needs('$channelId')
            ->give(function () {
                return $this->app['config']->get('apple-news.channel_id');
            });

        $this->app
            ->when(\Urbania\AppleNews\Laravel\Api::class)
            ->needs('$opts')
            ->give(function () {
                return [
                    'debug' => $this->app['config']->get('apple-news.debug', false),
                ];
            });

        $this->app->bind(
            \Urbania\AppleNews\Contracts\Api::class,
            \Urbania\AppleNews\Laravel\Api::class
        );
    }

    public function registerArticle()
    {
        $this->app->bind(\Urbania\AppleNews\Contracts\Article::class, function ($app) {
            $defaults = value($app['config']->get('apple-news.article', []));
            $article = new \Urbania\AppleNews\Article($defaults);
            return $article;
        });
    }

    public function registerParserManager()
    {
        $this->app->singleton('apple-news.parser-manager', function ($app) {
            return new ParserManager($app);
        });
    }

    public function registerAppleNews()
    {
        $this->app->singleton('apple-news', function ($app) {
            return new AppleNews($app, $app['apple-news.parser-manager']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
