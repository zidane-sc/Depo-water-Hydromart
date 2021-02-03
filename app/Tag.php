<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'device_controller_tags';


    protected $guarded = [];

    public function device(){
        return $this->belongsTo('App\Device','device_controller_id', 'id');
    }
}