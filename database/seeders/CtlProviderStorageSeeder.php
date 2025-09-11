<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlProviderStorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ctl_provider_storage')->insert([
            [
                "name" => "LOCAL",
                "code" => "LOCAL",
                "description" => "LOCAL",
                "active" => true
            ]
        ]);
    }
}
