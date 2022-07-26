<?php

namespace AMeheina\Querylyser\QueryChecks;

use Illuminate\Support\Facades\DB;

class FullTableScan extends QueryCheck
{
    public string $description = 'Check for full table scan';

    public string $fixRecommendation = 'Consider adding necessary index(es)';

    public function passes(): bool
    {
        return !collect(DB::select('EXPLAIN '.$this->query->statement_with_bindings))
            ->contains(function ($value, $key) {
                return $value->type === 'all' && $value->key === null;
            });
    }
}
