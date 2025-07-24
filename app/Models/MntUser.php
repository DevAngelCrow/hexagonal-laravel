<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MntUser extends Model
{
    protected $table = "mnt_user";
    protected $fillable = [
        "id",
        "id_people",
        "user_name",
        "password",
        "id_status",
        "last_access",
        "is_validated"
    ];

    public function people() : BelongsTo {
        return $this->belongsTo(MntPeople::class);
    }
    public function rol() : BelongsToMany{
        return $this->belongsToMany(MntRol::class, "user_rol", "id_user", "id_rol");
    }
    public function status() : BelongsTo {
        return $this->belongsTo(CtlStatusUser::class);
    }
}
