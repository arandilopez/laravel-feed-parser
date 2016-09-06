<?php namespace ArandiLopez\Feed\Providers;

use ArandiLopez\Feed\Factories\FeedFactory;
use ArandiLopez\Feed\Providers\FeedServiceProvider;

class LumenFeedServiceProvider extends FeedServiceProvider {
    public function boot(){}

    public function registerFeedFactory()
    {
        $config = include __DIR__ . '/../config/feed.php';
        $this->app->singleton('feed', function () use ($config) {
            if (!$config) {
                throw new \RunTimeException('Feed Parser configuration not found.');
            }
            return new FeedFactory($config);
        });
        
        if (! class_exists('Feed') ) {
            class_alias('ArandiLopez\Feed\Facades\Feed', 'Feed');
        }
    }
}
