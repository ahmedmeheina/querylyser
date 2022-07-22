<?php

namespace Ameheina\Querylyser;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ameheina\Querylyser\Skeleton\SkeletonClass
 */
class QuerylyserFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'querylyser';
    }
}
