<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goiot extends Model
{
    protected $table = 'goiot_setting';
    protected $guarded = [];
    protected $fillable = [
        'host',
        'deviceid',
        'clientid',
        'username',
        'password',
        'ph_tag',
        'tss_tag',
        'amonia_tag',
        'cod_tag',
        'flowmeter_tag'
    ];
}
