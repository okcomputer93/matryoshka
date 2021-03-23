<?php


namespace Okcomputer\Dolly;


use Illuminate\Support\Facades\Cache;

class RussianCaching
{
    protected static $keys = [];

    public static function setUp($model)
    {
         static::$keys[] = $key = $model->getCacheKey();

        // turn on output buffering
        ob_start();

        // return a boolean that indicates if we have cached this model yet
        return Cache::tags('views')->has($key);
    }

    public static function tearDown()
    {
        // fetch the cache key
        $key = array_pop(static::$keys);

        // save the output buffer contents to a variable, called $html
        $html = ob_get_clean();

        // cache it, if necessary, and echo out the html

        // rememberForever:  retrieve an item from the cache or store it forever if it does not exist:
        return Cache::tags('views')->rememberForever($key, function () use ($html) {
            return $html;
        });

    }

}
