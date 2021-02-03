<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'device_controllers';
    

    protected $guarded = [];


    public function tags()
    {
        return $this->hasMany('App\Tag', 'device_controller_id', 'id');
    }


    public function sensors()
    {
        return $this->hasMany('App\Sensor', 'gateway_id', 'id');
    }


    // public function delete()
    // {
    //     $this->tags()->delete();
    //     return parent::delete();
    // }
    
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($device) { // before delete() method call this
            $device->tags()->delete();
        });
    }
}
