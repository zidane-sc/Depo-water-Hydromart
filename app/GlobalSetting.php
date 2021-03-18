<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = [
        'id',
        'host_ip',
        'websocket_host',
        'websocket_port',
        'websocket_pool_interval',
        'db_host',
        'db_log_interval',
        'path_backup',
        'plant_name',
        'location',
        'logo',
        'schedule_second',
        'schedule_minute',
        'schedule_hour',
        'schedule_day_of_month',
        'month',
        'schedule_day_of_week',
    ];
}
