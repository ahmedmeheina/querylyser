<?php

namespace AMeheina\Querylyser\Listeners;

use AMeheina\Querylyser\Models\LoggedQuery;
use Illuminate\Database\Events\QueryExecuted;

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
