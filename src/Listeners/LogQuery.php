<?php

namespace AMeheina\Querylyser\Listeners;

use Illuminate\Database\Events\QueryExecuted;

class LogQuery
{
    public function handle(QueryExecuted $query)
    {
        dd($query->sql);
    }
}
