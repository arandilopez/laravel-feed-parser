<?php namespace ArandiLopez\FeedParser\Facades;

use Illuminate\Support\Facades\Facade;

class FeedParserFacade extends Facade {
    protected static function getFacadeAccessor() {
        return 'FeedParser';
    }
}
