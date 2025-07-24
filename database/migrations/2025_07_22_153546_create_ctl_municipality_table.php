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
        Schema::create('ctl_municipality', function (Blueprint $table) {
            $table->id();
            $table->integer("id_department");
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_department")->references("id")->on("ctl_department");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_municipality');
    }
};
