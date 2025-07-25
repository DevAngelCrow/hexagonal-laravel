<?php

namespace Database\Seeders;

use App\Models\CtlCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idCountry = CtlCountry::where("id", 1)->first();

        DB::table("ctl_department")->insert([
            "name" => "San Salvador",
            "id_country" => $idCountry->id,
            "description" => "País soberano"
        ]);
    }
}
