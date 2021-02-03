<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',  'server_url','uid', 'jwt_secret', 'send_interval'
    ];
}
