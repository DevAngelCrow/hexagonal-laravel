<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MntDocument extends Model
{
    use SoftDeletes;
    protected $table = "mnt_document";
    protected $fillable = [
        "id",
        "id_type_document",
        "id_people",
        "description",
        "state",
        "document_number"
    ];

    public function typeDocument() : BelongsTo {
        return $this->belongsTo(CtlTypeDocument::class);
    }
    public function people() : BelongsTo {
        return $this->belongsTo(MntPeople::class);
    }
}
