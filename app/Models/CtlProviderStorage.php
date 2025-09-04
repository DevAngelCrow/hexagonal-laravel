<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtlProviderStorage extends Model
{
    use SoftDeletes;
    protected $table = "ctl_provider_storage";
    protected $fillable = [
        "id",
        "name",
        "description",
        "active"
    ];

    public function storageFiles() : HasMany {
        return $this->hasMany(MntStorageFiles::class, "id_provider", "id");
    }
}
