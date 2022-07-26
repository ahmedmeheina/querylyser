<?php

namespace AMeheina\Querylyser\QueryChecks;

use AMeheina\Querylyser\Models\LoggedQuery;

abstract class QueryCheck
{
    public string $description;

    public string $fixRecommendation;

    public bool $passes;

    public function __construct(public LoggedQuery $query)
    {
        $this->passes = $this->passes();
    }

    abstract public function passes(): bool;
}
