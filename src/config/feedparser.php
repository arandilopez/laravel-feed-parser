<?php

/*-------------------------------------------
  Config file for FeedParser

  -------------------------------------------
 */

return [

  /*
    Where to store cache. Here we use Laravel and Lumen default
   */
  'cache.location' => storage_path() . '/framework/cache',

  /*
    Lifetime of cache
   */
  'cache.life'     => 3600,

  /*
    Wheter cache is enable in your context
   */
  'cache.enabled'  => true,
];
