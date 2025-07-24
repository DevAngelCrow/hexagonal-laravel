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
        Schema::create('rol_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer("id_rol");
            $table->integer("id_permission");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_rol")->references("id")->on("mnt_rol");
            $table->foreign("id_permission")->references("id")->on("ctl_permissions");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permissions');
    }
};
