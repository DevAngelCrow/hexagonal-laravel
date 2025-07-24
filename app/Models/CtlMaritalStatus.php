<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlMaritalStatus extends Model
{
    protected $table = "ctl_marital_status";
    protected $fillable = [
        "id",
        "name",
        "description"
    ];

    public function people(): HasOne{
        return $this->hasOne(MntPeople::class);
    }
}
