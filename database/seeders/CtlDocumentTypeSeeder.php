<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ctl_document_type')->insert([
            "name"=>"DUI",
            "description"=> "Documento Único de Identidad",
            "mask"=>"99999999-9",
            "active" => true,
        ]);
    }
}
