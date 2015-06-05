<?php namespace ArandiLopez\FeedParser\Adapters;

use SimplePie;
use Illuminate\Support\Str;

class SimplePieAdapter {

    protected $feeder;

    function __construct()
    {
        $this->feeder = new SimplePie();
    }

    public function getRawFeederObject()
    {
        return $this->feeder;
    }

    public function init()
    {
        $this->feeder->init();
    }

    public function __get($attribute)
    {
        $attr = Str::snake($attribute);
        return $this->feeder->get_$attr();
    }

    public function __set($attribute, $value)
    {
        $attr = Str::snake($attribute);
        $this->feeder->set_$attr($value);
    }

    // public function getTitle()
    // {
    //     return $this->feeder->get_title();
    // }
    //
    // public function getCategory()
    // {
    //     return $this->feeder->get_category();
    // }
    //
    // public function getCategories()
    // {
    //     return $this->feeder->get_categories();
    // }
    //
    // public function getAuthor()
    // {
    //     return $this->feeder->get_author();
    // }
    //
    // public function getAuthors()
    // {
    //     return $this->feeder->get_authors();
    // }
    //
    // public function getPermalink()
    // {
    //     return $this->feeder->get_permalink();
    // }
    //
    // public function getDescription()
    // {
    //     return $this->feeder->get_description();
    // }

    public function setFeedUrl($url)
    {
        $this->feeder->set_feed_url($url);
    }

    public function setTimeout( int $timeout )
    {
        $this->feeder->set_timeout($timeout);
    }

    public function loadConfig( array $config )
    {
        if( isset($config['cache.location']) )
            $this->feeder->set_cache_location($config['cache.location']);

        if( isset($config['cache.life']) )
            $this->feeder->set_cache_duration($config['cache.life']);

        if( isset($config['cache.enabled']) )
            $this->feeder->enable_cache($config['cache.enabled']);
    }
}
