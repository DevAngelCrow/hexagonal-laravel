<?php

namespace Database\Seeders;

use App\Models\MntRol;
use App\Models\MntUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MntUserRol extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idUser = MntUser::where("id", 1)->first();
        $idRol = MntRol::where("id", 1)->first();
        DB::table("mnt_user_rol")->insert([
            "id_role" => $idRol->id,
            "id_user" => $idUser->id,
            "created_at" => now()
        ]);
    }
}
