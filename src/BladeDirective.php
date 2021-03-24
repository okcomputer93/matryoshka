<?php

namespace Okcomputer\Matryoshka;

class BladeDirective 
{
    protected $cache;

    protected $keys = [];

    public function __construct(RussianCaching $cache) 
    {
        $this->cache = $cache;
    }


    public function setUp($model)
    {
        // turn on output buffering
        ob_start();

        $this->keys[] = $key = $model->getCacheKey();

        // return a boolean that indicates if we have cached this model yet
        return $this->cache->has($key);
        
    }

    public function tearDown()
    {
        // save the output buffer contents to a variable, called $html
        // fetch the cache key
        // cache it, if necessary, and echo out the html
        // rememberForever:  retrieve an item from the cache or store it forever if it does not exist:
        return $this->cache->put(
            array_pop($this->keys), ob_get_clean()
        );

    }

}