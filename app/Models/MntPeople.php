<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MntPeople extends Model
{
    protected $table = "mnt_people";
    protected $fillable = [
        "id",
        "first_name",
        "middle_name",
        "last_name",
        "birthdate",
        "id_gender",
        "email",
        "id_marital_status",
        "img_path",
        "phone",
        "id_status",
    ];

    public function user() : HasOne{
        return $this->hasOne(MntUser::class);
    }
    public function document() : HasMany {
        return $this->hasMany(MntDocument::class);
    }
    public function address() : HasMany {
        return $this->hasMany(MntAddress::class);
    }
    public function statusPeople() : BelongsTo {
        return $this->belongsTo(CtlStatusPeople::class);
    }
    public function maritalStatus() : BelongsTo {
        return $this->belongsTo(CtlMaritalStatus::class);
    }
    public function gender() : BelongsTo{
        return $this->belongsTo(CtlGender::class);
    }
}
