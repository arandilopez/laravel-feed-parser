<?php namespace ArandiLopez\Feed\Adapters;

use Illuminate\Support\Str;

class SimplePieItemAdapter {

    protected $item;

    function __construct($item)
    {
        $this->item = $item;
    }

    public function getRawItem()
    {
        return $this->item;
    }

    public function __get($attribute)
    {

    }
}
