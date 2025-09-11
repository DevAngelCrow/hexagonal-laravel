<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlGlobalStatus extends Model
{
    protected $table = "ctl_global_status";
    protected $fillable = [
        "name",
        "description",
        "table_header"
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user()
    {
        return $this->hasMany(MntUser::class, 'id_status');
    }

    public function people()
    {
        return $this->hasMany(MntPeople::class, 'id_status');
    }
    public function roles()
    {
        return $this->hasMany(MntRol::class, 'id_status');
    }
}
