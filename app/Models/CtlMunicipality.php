<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtlMunicipality extends Model
{
    protected $table = "ctl_municipality";
    protected $fillable = [
        "id",
        "id_department",
        "name",
        "description"
    ];

    public function district() : HasMany {
        return $this->hasMany(CtlDistrict::class);
    }
    public function department() : BelongsTo {
        return $this->belongsTo(CtlDepartment::class);
    }
}
