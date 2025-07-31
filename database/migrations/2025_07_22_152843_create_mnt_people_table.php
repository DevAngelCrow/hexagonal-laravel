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
        Schema::create('mnt_people', function (Blueprint $table) {
            $table->id();
            $table->string("first_name", length: 150);
            $table->string("middle_name", length: 150);
            $table->string("last_name", length: 150);
            $table->date("birthdate");
            $table->integer("id_gender");
            $table->string("email", length: 150)->unique();
            $table->integer("id_marital_status");
            $table->string("img_path");
            $table->string("phone", length: 14);
            $table->integer("id_status");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_gender")->references("id")->on("ctl_gender");
            $table->foreign("id_marital_status")->references("id")->on("ctl_marital_status");
            $table->foreign("id_status")->references("id")->on("ctl_status");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_people');
    }
};
