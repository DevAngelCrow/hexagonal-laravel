<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MntRoute extends Model
{
    protected $table = "mnt_route";
    protected $fillable = [
        "id",
        "id_parent",
        "name",
        "description",
        "icon",
        "uri",
        "active",
        "show",
        "order"
    ];

    public function permissions() : BelongsToMany {
        return $this->belongsToMany(CtlPermissions::class, "mnt_route_permissions", "id_route", "id_permission");
    }

    public function parent() : BelongsTo {
        return $this->belongsTo(MntRoute::class, "id_parent", "id");
    }

    public function children() : HasMany {
        return $this->hasMany(MntRoute::class, "id_parent","id");
    }

    public function RoutePermissions() : BelongsToMany {
        return $this->belongsToMany(CtlPermissions::class, "mnt_route_permissions", "id_route", "id_permission")->withTimestamps();
    }
}
