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
        Schema::create('mnt_route_permissions', function (Blueprint $table){
            $table->id();
            $table->integer("id_permission");
            $table->integer("id_route");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_permission")->references("id")->on("ctl_permissions");
            $table->foreign("id_route")->references("id")->on("mnt_route");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_route_permissions');
    }
};
