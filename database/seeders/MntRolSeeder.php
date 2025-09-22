<?php

namespace Database\Seeders;

use App\Models\CtlStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MntRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idStatusRol = CtlStatus::where("id", 3)->where("table_header", "mnt_role")->first();
        DB::table('mnt_role')->insert(
            [
                [
                    'name' => 'administrador',
                    'description' => 'Rol para el administrador',
                    'id_status' => $idStatusRol->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'supervisor',
                    'description' => 'Rol para el supervisor',
                    'id_status' => $idStatusRol->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'usuario',
                    'description' => 'Rol para el usuario',
                    'id_status' => $idStatusRol->id,
                    'created_at' => now(),
                ]
            ]
        );
    }
}
