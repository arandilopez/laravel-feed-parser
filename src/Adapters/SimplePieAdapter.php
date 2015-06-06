<?php namespace ArandiLopez\Feed\Adapters;

use SimplePie;
use Illuminate\Support\Str;
use ArandiLopez\Feed\Adapters\SimplePieItemAdapter as Item;
use ArandiLopez\Feed\Adapters\SimplePieAuthorAdapter as Author;

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
        if( $attribute === 'items' ) {
            return $this->getItems();
        }

        if ( $attribute === 'author' ) {
            return $this->getAuthor();
        }

        if ( $attribute === 'authors' ) {
            return $this->getAuthors();
        }
        $attr = Str::snake($attribute);
        $method = 'get_'.$attr;
        return $this->feeder->$method();
    }

    public function __set($attribute, $value)
    {
        $attr = Str::snake($attribute);
        $method = 'set_'.$attr;
        $this->feeder->$method($value);
    }

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
    public function getAuthor()
    {
        return new Author( $this->feeder->get_author() );
    }
    //
    public function getAuthors()
    {
        $authors = [];
        foreach ($this->feeder->get_authors() as $author) {
            array_push($authors, new Author($author));
        }

        return $authors;
    }

    public function getItems()
    {
        $items = [];
        foreach ($this->feeder->get_items() as $item) {
            array_push($items, new Item($item));
        }
        return $items;
    }

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
