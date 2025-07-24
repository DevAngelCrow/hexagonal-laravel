<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtlDepartment extends Model
{
    protected $table = "ctl_department";
    protected $fillable = [
        "id",
        "name",
        "description",
        "id_country",
    ];

    public function municipality() : HasMany {
        return $this->hasMany(CtlMunicipality::class);
    }
    public function country() : BelongsTo {
        return $this->belongsTo(CtlCountry::class);
    }
}
