<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = "mnt_user_rol";
    protected $fillable = [
        "id",
        "id_role",
        "id_user"
    ];
}
