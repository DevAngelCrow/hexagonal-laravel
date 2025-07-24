<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPermissions extends Model
{
    protected $table = "rol_permissions";
    protected $fillable = [
        "id",
        "id_rol",
        "id_permission"
    ];
}
