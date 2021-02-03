<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = true;

    protected $guard = [];

    public function getTestAttribute()
    {
        return $this->ph;
    }


}
