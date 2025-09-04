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
        Schema::create('mnt_user_rol', function (Blueprint $table) {
            $table->id();
            $table->integer("id_role");
            $table->integer("id_user");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_role")->references("id")->on("mnt_role");
            $table->foreign("id_user")->references("id")->on("mnt_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_user_rol');
    }
};
