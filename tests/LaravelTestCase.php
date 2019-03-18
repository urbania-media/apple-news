<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Orchestra\Testbench\TestCase as BaseTestCase;

class LaravelTestCase extends BaseTestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->instance('path.public', __DIR__.'/fixture');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Urbania\AppleNews\Laravel\AppleNewsServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [

        ];
    }
}
