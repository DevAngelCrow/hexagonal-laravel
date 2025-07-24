<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeopleCountry extends Model
{
    protected $table = "people_country";
    protected $fillable = [
        "id",
        "id_people",
        "id_country"
    ];
}
