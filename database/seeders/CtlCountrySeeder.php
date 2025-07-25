<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CtlCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("ctl_country")->insert([
            "name" => "El Salvador",
            "abbreviation" => "ES",
            "code" => "503",
            "state" => true,
        ]);
    }
}
