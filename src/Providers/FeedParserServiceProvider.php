<?php namespace ArandiLopez\FeedParser\Providers;

use Illuminate\Support\ServiceProvider;
use ArandiLopez\FeedParser\Factories\FeedFactory as Feed;

class FeedParserServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/feeds.php' => config_path('feedparser.php'),
        ]);
    }

    public function register()
    {
        $this->app['Feed'] = $this->app->share(function($app) {
            $config = config('feedparser');
            if (!$config) {
                throw new \RunTimeException('FeedParser configuration not found. Please run `php artisan vendor:publish`');
            }
            return new Feed($config);
        });
    }

    public function provides()
    {
        return ['Feed'];
    }

}
