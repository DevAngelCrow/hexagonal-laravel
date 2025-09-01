<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MntStorageFiles extends Model
{
    use SoftDeletes;
    protected $table = "mnt_storage_files";
    protected $fillable = [
        "id",
        "filename",
        "path",
        "id_provider",
        "size",
        "mime_type",
        "id_user",
        "active"
    ];

    public function provider_storage() : BelongsTo {
        return $this->belongsTo(CtlProviderStorage::class, "id_provider", "id");
    }
    public function users() : BelongsTo {
        return $this->belongsTo(MntUser::class, "id_user", "id");
    }
}
