<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people_country', function (Blueprint $table) {
            $table->id();
            $table->integer("id_people");
            $table->integer("id_country");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_people")->references("id")->on("mnt_people");
            $table->foreign("id_country")->references("id")->on("ctl_country");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_country');
    }
};
