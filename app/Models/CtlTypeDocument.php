<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CtlTypeDocument extends Model
{
    protected $table = "ctl_type_document";
    protected $fillable = [
        "id", "name", "description"
    ];

    public function document(): HasOne {
        return $this->hasOne(MntDocument::class);
    }
}
