<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlGender extends Model
{
    protected $table = "ctl_gender";
    protected $fillable = [
        "id",
        "name"
    ];

    public function people() : HasOne {
        return $this->hasOne(MntPeople::class);
    }
}
