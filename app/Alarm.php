<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'tstamp', 'tag_name', 'value', 'formula', 'sp', 'text', 'created_by', 'status', 'acknowledge_tstamp',
    ];
}
