<?php

namespace Database\Seeders;

use App\Models\CtlPermissions;
use App\Models\MntRol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idRole = MntRol::where("id", 1)->first();
        $idPermissions = CtlPermissions::select("id")->orderBy('id')->get()->all();
        
        $collection = array_map(fn($item)=> ['id_role' => $idRole->id, 'id_permission' => $item->id, 'created_at'=> now()], $idPermissions);

        
        DB::table('rol_permissions')->insert(
            $collection
        );
    }
}
