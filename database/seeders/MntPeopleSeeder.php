<?php

namespace Database\Seeders;

use App\Models\CtlGender;
use App\Models\CtlMaritalStatus;
use App\Models\CtlStatus;
use App\Models\CtlStatusPeople;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MntPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idGender = CtlGender::where("id", 1)->first();
        $idMaritalStatus = CtlMaritalStatus::where("id", 1)->first();
        $idStatusPeople = CtlStatus::where("id", 1)->where("table_header", "mnt_people")->first();
        DB::table('mnt_people')->insert([
            "first_name"=>"test",
            "middle_name"=>"test",
            "last_name"=>"test",
            "birthdate"=>"2025-01-01",
            "id_gender"=>$idGender->id,
            "email"=>"test@mail.com",
            "id_marital_status"=> $idMaritalStatus->id,
            "img_path"=>"test/test",
            "phone"=>"22222222",
            "id_status"=>$idStatusPeople->id,
        ]);
    }
}
