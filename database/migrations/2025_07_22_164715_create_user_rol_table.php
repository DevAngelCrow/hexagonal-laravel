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
        Schema::create('user_rol', function (Blueprint $table) {
            $table->id();
            $table->integer("id_rol");
            $table->integer("id_user");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_rol")->references("id")->on("mnt_rol");
            $table->foreign("id_user")->references("id")->on("mnt_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rol');
    }
};
