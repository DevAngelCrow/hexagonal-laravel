<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtlCategoryPermissions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "ctl_category_permissions";
    protected $fillable = [
        "id", "name", "description", "active"
    ];

    public function permissions() : HasMany {
        return $this->hasMany(CtlPermissions::class, "id_category_permissions");
    }
}
