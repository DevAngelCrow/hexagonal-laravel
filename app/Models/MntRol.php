<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MntRol extends Model
{
    protected $table = "mnt_rol";
    protected $fillable = [
        "id",
        "name",
        "description",
        "id_status"
    ];

    public function user() : BelongsToMany {
        return $this->belongsToMany(MntUser::class);
    }
    public function statusRol() : BelongsTo {
        return $this->belongsTo(CtlStatusRol::class);
    }
    public function permissions() : BelongsToMany {
        return $this->belongsToMany(CtlPermissions::class, "rol_permissions", "id_rol", "id_permission");
    }
}
