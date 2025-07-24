<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlStatusPeople extends Model
{
    protected $table = "ctl_status_people";
    protected $fillable = [
        "id", "name"
    ];
}
