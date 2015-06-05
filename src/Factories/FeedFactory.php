<?php namespace ArandiLopez\FeedParser\Factories;

use ArandiLopez\FeedParser\Adapters\SimplePieAdapter as FeedAdapter;

class FeedFactory {

    protected $config;
    protected $feed;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function fetch($url)
    {
        $this->feed = new FeedAdapter();
        $this->feed->loadConfig($this->config);
        $this->feed->setFeedUrl($url);
        $this->feed->init();

        return $this->feed;
    }
}
