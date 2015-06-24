<?php

namespace ArandiLopez\Feed\Adapters;

use SimplePie;
use Illuminate\Support\Str;
use ArandiLopez\Feed\Adapters\SimplePieItemAdapter as Item;
use ArandiLopez\Feed\Adapters\SimplePieAuthorAdapter as Author;
use JsonSerializable;
use ArrayAccess;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class SimplePieAdapter implements JsonSerializable, Jsonable, ArrayAccess, Arrayable
{
    protected $feeder;

    public function __construct()
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
        if ($attribute === 'items') {
            return $this->getItems();
        }

        if ($attribute === 'author') {
            return $this->getAuthor();
        }

        if ($attribute === 'authors') {
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
        if ($author = $this->feeder->get_author()) {
            return new Author($author);
        }

        return '';
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

    public function setTimeout(int $timeout)
    {
        $this->feeder->set_timeout($timeout);
    }

    public function loadConfig(array $config)
    {
        if (isset($config['cache.location'])) {
            $this->feeder->set_cache_location($config['cache.location']);
        }

        if (isset($config['cache.life'])) {
            $this->feeder->set_cache_duration($config['cache.life']);
        }

        if (isset($config['cache.enabled'])) {
            $this->feeder->enable_cache($config['cache.enabled']);
        }

        if (isset($config['item_limit'])) {
            $this->feeder->set_item_limit($config['item_limit']);
        }
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($option = 0)
    {
        return json_encode($this->toArray(), $option);
    }

    /**
     * Only return items.
     *
     * @return Array $items
     */
    public function toArray()
    {
        return array_map(function ($item) {
                    return $item->toArray();
                }, $this->items);
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Set the value for a given offset.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}
