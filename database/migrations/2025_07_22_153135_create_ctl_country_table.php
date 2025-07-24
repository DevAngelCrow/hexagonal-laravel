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
        Schema::create('ctl_country', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("abbreviation", length: 150);
            $table->string("code", length: 150);
            $table->boolean("state");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_country');
    }
};
