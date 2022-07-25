<?php

namespace AMeheina\Querylyser\QueryChecks;

use AMeheina\Querylyser\Models\LoggedQuery;

abstract class QueryCheck
{
    public function __construct(private LoggedQuery $query)
    {}

    public string $description;

    public string $fixRecommendation;

    abstract public function passes():bool;
}
