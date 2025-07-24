<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlStatusRol extends Model
{
    protected $table = "ctl_status_rol";
    protected $fillable = [
        "id", "name", "description"
    ];

    public function rol() : HasOne {
        return $this->hasOne(MntRol::class);
    }
}
