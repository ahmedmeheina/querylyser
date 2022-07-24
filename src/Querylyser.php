<?php

namespace AMeheina\Querylyser;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Querylyser
{
    public function canLogQuery($sql): bool
    {
        if (Cache::get('LogQueries') !== 'start'){
            return false;
        }

        if($this->isSelfQuery($sql)){
            return false;
        }

        if(!$this->isReadQuery($sql)){
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

    public function getQueryFromSqlAndBindings(string $sql, array $bindings)
    {
        return Str::replaceArray('?', $bindings, $sql);
    }
}
