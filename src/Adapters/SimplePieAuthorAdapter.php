<?php namespace ArandiLopez\Feed\Adapters;

use Illuminate\Support\Str;

class SimplePieAuthorAdapter {

    protected $author;

    function __construct($author)
    {
        $this->author = $author;
    }

    public function getRawAuthor()
    {
        return $this->author;
    }

    public function __get($attribute)
    {
        $attr = Str::snake($attribute);
        $method = 'get_'.$attr;
        return $this->author->$method();
    }
}
