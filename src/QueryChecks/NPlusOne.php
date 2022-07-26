<?php

namespace AMeheina\Querylyser\QueryChecks;

class NPlusOne extends QueryCheck
{
    public string $description = 'Simple Check for N+1 violation';

    public string $fixRecommendation = 'Consider Eager Loading https://laravel.com/docs/5.2/eloquent-relationships#eager-loading';

    public function passes(): bool
    {
        $sameQuery = $this->query->statement === $this->query->previous()?->statement;

        if (! $sameQuery) {
            return true;
        }

        $differentBindings = $this->query->statement_with_bindings !== $this->query->previous()?->statement_with_bindings;

        return ! $differentBindings;
    }
}
