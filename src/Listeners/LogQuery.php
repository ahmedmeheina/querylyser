<?php

namespace AMeheina\Querylyser\Listeners;

use AMeheina\Querylyser\Models\LoggedQuery;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Cache;

class LogQuery
{
    public function handle(QueryExecuted $query)
    {
        if(Cache::get('LogQueries') !== 'start')
        {
            return;
        }

        $loggedQuery = new LoggedQuery();
        $loggedQuery->sql = $query->sql;
        $loggedQuery->time = $query->time;
        $loggedQuery->save();
    }
}
