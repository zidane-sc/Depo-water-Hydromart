<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';
    protected $guard = [];
    protected $fillable = ['sensor','value','status','user_id'];

    public function sensors()
    {
        return $this->belongsTo('App\Sensor', 'sensor', 'sensor_name');
    }

    public function status(){
        if($this->status == 1){
            return "<span class='badge badge-success'>Enable</span>";
        }else{
            return "<span class='badge badge-danger'>Disable</span>";
        }
    }
    
}
