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
        "id_document_type",
        "id_people",
        "description",
        "state",
        "document_number"
    ];

    public function typeDocument() : BelongsTo {
        return $this->belongsTo(CtlDocumentType::class,'id_document_type', 'id');
    }
    public function people() : BelongsTo {
        return $this->belongsTo(MntPeople::class);
    }
}
