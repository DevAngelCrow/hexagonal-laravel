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
        Schema::create('ctl_district', function (Blueprint $table) {
            $table->id();
            $table->integer("id_municipality");
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->boolean("state");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_municipality")->references("id")->on("ctl_municipality");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_district');
    }
};
