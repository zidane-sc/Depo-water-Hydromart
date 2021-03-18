<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartementPrivilege extends Model
{
    public $timestamps = true;

    protected $table = 'departement_privilege';
    protected $guarded = []; // blacklist

}
