<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlarmSetting extends Model
{
    public $timestamps = true;
    protected $table = 'alarm_settings';
    protected $guarded = [];
}
