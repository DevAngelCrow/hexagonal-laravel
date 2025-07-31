<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtlStatus extends Model
{
    use SoftDeletes;

    protected $table = "ctl_status";
    protected $fillable = [
        "id",
        "table_header",
        "name",
        "description"
    ];

    public function user() : HasMany {
        return $this->hasMany(MntUser::class, "id_status");
    }
    public function people() : HasMany {
        return $this->hasMany(MntPeople::class, "id_status");
    }
    public function rol() : HasMany {
        return $this->hasMany(MntRol::class, "id_status");
    }
}
