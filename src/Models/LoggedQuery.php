<?php

namespace AMeheina\Querylyser\Models;

use Illuminate\Database\Eloquent\Model;

class LoggedQuery extends Model
{
    protected $table = 'logged_query';

    protected $guarded = [];
}
