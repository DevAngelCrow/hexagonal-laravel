<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MntAddress extends Model
{
    protected $table = "mnt_address";
    protected $fillable = [
        "id",
        "id_people",
        "street",
        "street_number",
        "neighborhood",
        "id_district",
        "house_number",
        "block",
        "pathway",
        "current"
    ];

    public function people() : BelongsTo {
        return $this->belongsTo(MntPeople::class);
    }
    public function district() : BelongsTo{
        return $this->belongsTo(CtlDistrict::class);
    }
}
