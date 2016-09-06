<?php namespace ArandiLopez\Feed\Providers;

use Illuminate\Support\ServiceProvider;
use ArandiLopez\Feed\Factories\FeedFactory;

class FeedServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/feed.php' => config_path('feed.php'),
        ]);
    }

    public function register()
    {
        $this->registerFeedFactory();
    }

    protected function registerFeedFactory()
    {
        $this->app->singleton('feed', function () {
            $config = config('feed');
            if (!$config) {
                throw new \RunTimeException('Feed Parser configuration not found. Please run `php artisan vendor:publish`');
            }
            return new FeedFactory($config);
        });
        $this->app->alias('feed', 'ArandiLopez\Feed\Factories\FeedFactory');
    }

    public function provides()
    {
        return ['feed'];
    }

}
