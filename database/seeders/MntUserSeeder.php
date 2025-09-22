<?php

namespace Database\Seeders;

use App\Models\CtlStatus;
use App\Models\MntPeople;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MntUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idPeople = MntPeople::where("id", 1)->first();
        $idStatusUser = CtlStatus::where("id", 2)->where("table_header", "mnt_user")->first();
        DB::table('mnt_user')->insert([
            'id_people'=>$idPeople->id,
            'user_name'=>'admin',
            'password'=> Hash::make('$admin123'),
            'id_status' => $idStatusUser->id,
            'last_access' => now(),
            'is_validated' => true,
            'email_verified_at' => now(),
        ]);
    }
}
