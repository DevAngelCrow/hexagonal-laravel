<?php

namespace Database\Seeders;

use App\Models\CtlMunicipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idMunicipality = CtlMunicipality::where("id", 1)->first();

        DB::table('ctl_district')->insert([
            "id_municipality" => $idMunicipality->id,
            "name" => "Soyapango",
            "description" => "Distrito de San Salvador Este",
            "state" => true,
        ]);
    }
}
