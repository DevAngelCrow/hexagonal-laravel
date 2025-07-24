<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtlCountry extends Model
{
    use HasFactory;

    protected $table = "ctl_country";
    protected $fillable = [
        "id",
        "name",
        "abbreviation",
        "code",
        "state"
    ];

    public function country() : HasMany {
        return $this->hasMany(CtlDepartment::class);
    }
    public function people() : BelongsToMany {
        return $this->belongsToMany(MntPeople::class, "people_country", "id_country", "id_people" );
    }
}
