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
        Schema::create('mnt_address', function (Blueprint $table) {
            $table->id();
            $table->integer("id_people");
            $table->string("street", length: 150);
            $table->string("street_number", length: 150);
            $table->string("neighborhood", length: 150);
            $table->integer("id_district");
            $table->string("house_number", length: 150);
            $table->string("block", length: 150);
            $table->string("pathway", length: 150);
            $table->boolean("current");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_district")->references("id")->on("ctl_district");
            $table->foreign("id_people")->references("id")->on("mnt_people");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_address');
    }
};
