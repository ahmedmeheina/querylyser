<?php

namespace AMeheina\Querylyser\QueryChecks;

class QueryRuntime extends QueryCheck
{
    public string $description = 'Check run time of a query against threshold';

    public string $fixRecommendation = 'TBD';

    public function passes(): bool
    {
        return $this->query->time < config('querylyser.max_query_time');
    }
}
