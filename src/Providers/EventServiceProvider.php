<?php

namespace AMeheina\Querylyser\Providers;

use AMeheina\Querylyser\Listeners\LogQuery;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        QueryExecuted::class => [
            LogQuery::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
