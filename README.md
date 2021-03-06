# Laravel and Lumen Feed parser
![](https://travis-ci.org/arandilopez/laravel-feed-parser.svg?branch=master) [![Latest Stable Version](https://poser.pugx.org/arandilopez/laravel-feed-parser/v/stable)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![Total Downloads](https://poser.pugx.org/arandilopez/laravel-feed-parser/downloads)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![Latest Unstable Version](https://poser.pugx.org/arandilopez/laravel-feed-parser/v/unstable)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![License](https://poser.pugx.org/arandilopez/laravel-feed-parser/license)](https://packagist.org/packages/arandilopez/laravel-feed-parser)

A [Laravel](http://laravel.com) and [Lumen](http://lumen.laravel.com) package for parse RSS Feeds using SimplePie.

## Instalation
You can install this package with [composer](http://getcomposer.org) by typing in your console: `composer require 'arandilopez/laravel-feed-parser:dev-master'` or adding this at your project's `composer.json`.

```json
"require": {
  "arandilopez/laravel-feed-parser": "0.1.*"
}
```
## Configuration
### Laravel 5.1 (Pending Test)
Register the `FeedServiceProvider` in your `providers` array in `config/app.php` in [Laravel 5.1](http://laravel.com)

```php
'providers' => [
  // ...

  ArandiLopez\Feed\Providers\FeedServiceProvider::class,
],
```

### Lumen 5.1
Register the `LumenFeedServiceProvider` in your `bootstrap/app.php` in [Lumen 5.1](http://lumen.laravel.com)

```php
// $app->register(App\Providers\AppServiceProvider::class);
$app->register(ArandiLopez\Feed\Providers\LumenFeedServiceProvider::class);

```
In order to use the Facade `Feed` you have to uncomment this line:

```php

$app->withFacades();

```
### Environment Configuration
Laravel and Lumen use `.env` files for their configuration. To change defaults configuration of Feed Parser add this environment variables in your `.env` file:

- FEED_CACHE_LIFE (Set cache lifetime. Expects an integer. Defaults 3600).
- FEED_CACHE_ENABLED (Enable cache. Expects a boolean. Defaults true).

> Cache location is set default to storage laravel path

## Usage

### Quick Lumen example
```php

$app->get('/feed', function() {
  $myFeed = Feed::make('http://arandilopez.me/feed.xml');

  return response()->json($myFeed);
});

```
You can get the whole SimplePie instance by doing:
```php
$myFeed = Feed::make('http://arandilopez.me/feed.xml');
$simplePieInstance = $myFeed->getRawFeederObject();

// do configs and whatever with the instance 

```

> Check SimplePie's configuration and Docs at [simplepie.org/wiki/](http://simplepie.org/wiki/)

## Contributing
Yes, please.

Any feedback, errors or features suggestions [are welcome in the issues](https://github.com/arandilopez/laravel-feed-parser/issues/new)
