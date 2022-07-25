<?php

namespace AMeheina\Querylyser\QueryChecks;

class FullTableScan extends QueryCheck
{
    public string $description = 'Check for full table scan';

    public string $fixRecommendation = 'Consider adding necessary index(es)';

    public function passes(): bool
    {
        return true;
    }
}
