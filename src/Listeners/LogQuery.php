<?php

namespace AMeheina\Querylyser\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use AMeheina\Querylyser\Models\LoggedQuery;

class LogQuery
{
    public function handle(QueryExecuted $query)
    {
        $loggedQuery = new LoggedQuery();
        $loggedQuery->sql = $query->sql;
        $loggedQuery->time = $query->time;
        $loggedQuery->save();
    }
}
