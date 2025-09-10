<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MntRol extends Model
{
    protected $table = "mnt_role";
    protected $fillable = [
        "id",
        "name",
        "description",
        "id_status",
        "active"
    ];

    public function user() : BelongsToMany {
        return $this->belongsToMany(MntUser::class);
    }
    public function status() : BelongsTo {
        return $this->belongsTo(CtlGlobalStatus::class,'id_status');
    }
    public function permissions() : BelongsToMany {
        return $this->belongsToMany(CtlPermissions::class, "rol_permissions", "id_role", "id_permission")->withTimestamps();
    }
}
