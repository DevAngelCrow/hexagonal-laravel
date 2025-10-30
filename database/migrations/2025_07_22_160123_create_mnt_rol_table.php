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
        Schema::create('mnt_role', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->integer("id_status");
            $table->timestamps();
            $table->softDeletes();
            //$table->boolean("active")->default(true);
            $table->foreign("id_status")->references("id")->on("ctl_status");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_role');
    }
};
