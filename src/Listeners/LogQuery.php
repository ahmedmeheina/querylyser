<?php

namespace AMeheina\Querylyser\Listeners;

use AMeheina\Querylyser\Models\LoggedQuery;
use AMeheina\Querylyser\QuerylyserFacade as Querylyser;
use Illuminate\Database\Events\QueryExecuted;

class LogQuery
{
    public function handle(QueryExecuted $query)
    {
        if (! Querylyser::isLoggable($query->sql)) {
            return;
        }

        $loggedQuery = new LoggedQuery();
        $loggedQuery->statement = $query->sql;
        $loggedQuery->statement_with_bindings = Querylyser::getQueryFromSqlAndBindings($query->sql, $query->bindings);
        $loggedQuery->time = $query->time;
        $loggedQuery->backtrace = Querylyser::getBacktrace();
        $loggedQuery->save();
    }
}
