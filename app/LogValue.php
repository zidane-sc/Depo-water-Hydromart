<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogValue extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'device_name', 'tag_name', 'time', 'project_id', 'value'
    ];

}
