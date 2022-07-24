<?php

namespace AMeheina\Querylyser;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AMeheina\Querylyser\Skeleton\SkeletonClass
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
