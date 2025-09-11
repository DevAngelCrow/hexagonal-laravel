<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtlDocumentType extends Model
{
    use SoftDeletes;

    protected $table = "ctl_document_type";
    protected $fillable = [
        "id",
        "name",
        "description",
        "active"
    ];

    public function documentos() : HasOne {
        return $this->hasOne(MntDocument::class, 'id_document_type', 'id');
    }
    
}
