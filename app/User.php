<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'departement_id', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function departement()
    // {
    //     return $this->hasMany('App\Departement');
    // }

    public function departement()
    {
        return $this->belongsTo('App\Departement');
    }

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role', 'role_user')
            ->withTimestamps();
    }

    public function getRoles()
    {
        return $this->roles()->where('names', 'ROLE_ADMIN')->first();

    }

    public function hasPrivilege($privilege)
    {
        // Auth::logout();
        // dd(Auth::guard('web')->user()->departement);

        if ($this->departement()->count() > 0) {
            $id = $this->departement()->first()->id;
            $cekPrivilege = app('App\Departement')::findOrFail($id)->privileges()->where('name', $privilege)->get();
            if ($cekPrivilege->count()) {
                return true;
            } else {
                return false;
            }
        } else {
            // Cek jika departement tidak terdaftar
            return 403;
        }

    }
}
