<?php

namespace Database\Seeders;

use App\Models\CtlDistrict;
use App\Models\MntPeople;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MntAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idPeople = MntPeople::where("id", 1)->first();
        $idDistrict = CtlDistrict::where("id", 1)->first();
        DB::table('mnt_address')->insert(
            [
                [
                    "id_people"=> $idPeople->id,
                    "street" => "Calle test",
                    "street_number" => "125",
                    "neighborhood" => "Residencial test",
                    "id_district" => $idDistrict->id,
                    "house_number" => "78",
                    "block" => "J",
                    "pathway" => "pasaje test",
                    "current" => true,
                    "active" => true
                ]
            ]
        );
    }
}
