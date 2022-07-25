<?php

namespace AMeheina\Querylyser\Models;

use Illuminate\Database\Eloquent\Model;

class LoggedQuery extends Model
{
    protected $table = 'logged_query';

    protected $guarded = [];

    public function previous()
    {
        return LoggedQuery::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
}
