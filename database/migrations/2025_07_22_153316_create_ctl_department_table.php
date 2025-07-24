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
        Schema::create('ctl_department', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->integer("id_country");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_country")->references("id")->on("ctl_country");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_department');
    }
};
