# Laravel and Lumen Feed parser
![](https://travis-ci.org/arandilopez/laravel-feed-parser.svg?branch=master) [![Latest Stable Version](https://poser.pugx.org/arandilopez/laravel-feed-parser/v/stable)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![Total Downloads](https://poser.pugx.org/arandilopez/laravel-feed-parser/downloads)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![Latest Unstable Version](https://poser.pugx.org/arandilopez/laravel-feed-parser/v/unstable)](https://packagist.org/packages/arandilopez/laravel-feed-parser) [![License](https://poser.pugx.org/arandilopez/laravel-feed-parser/license)](https://packagist.org/packages/arandilopez/laravel-feed-parser)

A [Laravel](http://laravel.com) and [Lumen](http://lumen.laravel.com) package for parse RSS Feeds using SimplePie.

## Instalation
You can install this package with [composer](http://getcomposer.org) by typing in your console: `composer require 'arandilopez/laravel-feed-parser:dev-master'` or adding this at your project's `composer.json`.

```json
"require": {
  "arandilopez/laravel-feed-parser": "dev-master"
}
```
## Configuration
### Laravel 5
Register the `FeedServiceProvider` in your `providers` array in `config/app.php` in [Laravel 5](http://laravel.com)

```php
'providers' => [
  // ...

  'ArandiLopez\Feed\Providers\FeedServiceProvider',
],
```

### Lumen
Register the `FeedServiceProvider` and `Feed` Facade in your `bootstrap/app.php` in [Lumen](http://lumen.laravel.com)

```php
// ...
$app->register('ArandiLopez\Feed\Providers\FeedServiceProvider');

class_alias('Feed', 'Arandi\Feed\Facades\Feed');

```

## Usage

## Contributing
Yes, please.
