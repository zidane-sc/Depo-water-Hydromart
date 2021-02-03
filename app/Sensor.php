<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $guarded = ['sensor_name'];


    public function device()
    {
        return $this->belongsTo('App\Device', 'gateway_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag', 'tag_id', 'id');
    }


    public function maintenance()
    {
        return $this->belongsTo('App\Maintenance', 'sensor', 'sensor_name');
    }


    public function getStatusBadgeAttribute()
    {
        if ($this->sensor_status == 0) return '<span class="badge badge-danger">Disabled</span>';
        if ($this->sensor_status == 1) return '<span class="badge badge-success">Enabled</span>';
        return 'Not Available';
    }

    public function getUnitAttribute()
    {
        if ($this->sensor_name == 'ph') return 'pH';
        if ($this->sensor_name == 'flow_meter') return 'm3/h';
        return 'mg/l';
    }

  
}


