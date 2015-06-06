<?php namespace ArandiLopez\Feed\Factories;

use ArandiLopez\Feed\Adapters\SimplePieAdapter;

class FeedFactory {

    protected $config;
    protected $feed;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function make($url)
    {
        $this->feed = new SimplePieAdapter();
        $this->feed->loadConfig($this->config);
        $this->feed->setFeedUrl($url);
        $this->feed->init();

        return $this->feed;
    }
}
