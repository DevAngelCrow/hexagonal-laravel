<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntRoutePermissions extends Model
{
    protected $table = "mnt_route_permissions";
    protected $fillable = [
        "id",
        "id_route",
        "id_permission"
    ];
}