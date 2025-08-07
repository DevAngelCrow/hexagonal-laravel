<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CtlPermissions extends Model
{
    protected $table = "ctl_permissions";
    protected $fillable = [
        "id",
        "name",
        "description",
        "id_category_permissions"
    ];

    public function rol() : BelongsToMany {
        return $this->belongsToMany(MntRol::class, "rol_permissions", "id_permission", "id_rol");
    }
    public function categoriPermissions(): BelongsTo{
        return $this->belongsTo(CtlCategoryPermissions::class, "id_category_permissions");
    }
}
