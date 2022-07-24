<?php

namespace AMeheina\Querylyser\Listeners;

use AMeheina\Querylyser\Models\LoggedQuery;
use Illuminate\Database\Events\QueryExecuted;
use AMeheina\Querylyser\QuerylyserFacade as Querylyser;

class LogQuery
{
    public function handle(QueryExecuted $query)
    {
        if(!Querylyser::canLogQuery($query->sql))
        {
            return;
        }

        $loggedQuery = new LoggedQuery();
        $loggedQuery->sql = Querylyser::getQueryFromSqlAndBindings($query->sql, $query->bindings);
        $loggedQuery->time = $query->time;
        $loggedQuery->backtrace = Querylyser::getBacktrace();
        $loggedQuery->save();
    }
}
