<?php

namespace AMeheina\Querylyser;

use AMeheina\Querylyser\Report\Generator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Querylyser
{
    public function isLoggable($sql): bool
    {
        if (Cache::get('LogQueries') !== 'start') {
            return false;
        }

        if ($this->isSelfQuery($sql)) {
            return false;
        }

        if (! $this->isReadQuery($sql)) {
            return false;
        }

        return true;
    }

    private function isSelfQuery($sql): bool
    {
        return Str::contains($sql, 'logged_query');
    }

    private function isReadQuery($sql): bool
    {
        return Str::startsWith(trim($sql), ['select', 'SELECT', 'Select']);
    }

    public function getQueryFromSqlAndBindings(string $sql, array $bindings): string
    {
        return vsprintf(Str::replace('?', '\'%s\'', $sql), $bindings);
    }

    public function getBacktrace(): string
    {
        // to get exact query caller line, we need to find the first non-framework call from the php backtrace
        $backtrace = collect(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 0))
            ->reject(function ($value) {
                if (! isset($value['file'])) {
                    return true;
                }

                return Str::contains($value['file'], '/vendor');
            })
            ->first();

        return $backtrace['file'].':'.$backtrace['line'];
    }

    public function loadChecks(): Collection
    {
        return collect(config('querylyser.checks'))
            ->map(function ($check) {
                return 'AMeheina\Querylyser\QueryChecks\\'.Str::replace('_', '', Str::title($check));
            });
    }

    public function generateReport(Collection $results): string
    {
        return (new Generator())->generate($results);
    }
}
