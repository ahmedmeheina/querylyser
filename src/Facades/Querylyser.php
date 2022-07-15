<?php

namespace Ameheina\Querylyser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ameheina\Querylyser\Querylyser
 */
class Querylyser extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'querylyser';
    }
}
