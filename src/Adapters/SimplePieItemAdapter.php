<?php namespace ArandiLopez\FeedParser\Adapters;

class SimplePieItemAdapter {

    protected $item;

    function __construct($item)
    {
        $this->item = $item;
    }
}
