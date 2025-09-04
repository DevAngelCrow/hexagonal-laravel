<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ctl_status')->insert([
            [
                "table_header" => "mnt_people",
                "name" => "Activo",
                "description" => "Estado activo",
                "state" => true
            ],
            [
                "table_header" => "mnt_user",
                "name" => "Activo",
                "description" => "Estado activo",
                "state" => true
            ],
            [
                "table_header" => "mnt_role",
                "name" => "Activo",
                "description" => "Estado activo",
                "state" => true
            ]
        ]);
    }
}
