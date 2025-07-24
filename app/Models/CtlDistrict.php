<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlDistrict extends Model
{
    protected $table = "ctl_district";
    protected $fillable = ["id","id_municipality","name", "description", "state"];

    public function address() : HasOne {
        return $this->hasOne(MntAddress::class);
    }
    public function municipality() : BelongsTo {
        return $this->belongsTo(CtlMunicipality::class);
    }
}
