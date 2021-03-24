<?php

use Okcomputer\Dolly\BladeDirective;
use Okcomputer\Dolly\RussianCaching;

class BladeDirectiveTest extends TestCase 
{

    protected $doll;

    /** @test */
    function it_sets_the_opening_cache_directive() 
    {
        // new up the BladeDirective class.
        $directive = $this->createNewCacheDirective();

        // and then call the setUp method.
        $isCached = $directive->setUp($model = $this->makePost());

        // perform assertion.
        $this->assertFalse($isCached);

        $fragment = '<div>fragment</div>';

        echo $fragment;

        // call the tearDown method.
        $cachedFragment = $directive->tearDown();

        // perform assertion.
        $this->assertEquals($fragment, $cachedFragment);
        $this->assertTrue($this->doll->has($model));
    }

    protected function createNewCacheDirective()
    {
        $cache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore
        );

        return new BladeDirective($this->doll = new RussianCaching($cache));
    }
}