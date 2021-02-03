<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    public $timestamps = true;

    public function privileges()
    {
        return $this
            ->belongsToMany('App\Privilege')
            ->withTimestamps();
    }

    public function privilege($id)
    {
        return $this->privileges()->where('departement_id', $id)->orderBy('name', 'asc');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    protected $fillable = [
        'name', 'description',
    ];

}
