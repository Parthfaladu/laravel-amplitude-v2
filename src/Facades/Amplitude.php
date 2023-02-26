<?php

namespace Faladu\Amplitude\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Faladu\Amplitude\Amplitude
 */
class Amplitude extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Faladu\Amplitude\Amplitude::class;
    }
}
