<?php

namespace Database\Seeders;

use App\Models\CtlDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlMunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idDepartment = CtlDepartment::where("id", 1)->first();

        DB::table("ctl_municipality")->insert([
            "id_department"=>$idDepartment->id,
            "name"=>"San Salvador Este",
            "description"=>"Municipio de San Salvador"
        ]);
    }
}
