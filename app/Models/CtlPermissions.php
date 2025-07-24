<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CtlPermissions extends Model
{
    protected $table = "ctl_permissions";
    protected $fillable = [
        "id",
        "name",
        "description"
    ];

    public function rol() : BelongsToMany {
        return $this->belongsToMany(MntRol::class, "rol_permissions", "id_permission", "id_rol");
    }
}
