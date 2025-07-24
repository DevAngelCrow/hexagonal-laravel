<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlStatusUser extends Model
{
    protected $table = "ctl_status_user";
    protected $fillable = [
        "id", "name", "description"
    ];

    public function user() : HasOne {
        return $this->hasOne(MntUser::class);
    }
}
