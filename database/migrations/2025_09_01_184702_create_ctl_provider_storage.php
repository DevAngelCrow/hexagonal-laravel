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
        Schema::create('ctl_provider_storage', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("code", length: 6);
            $table->string("description", length: 150);
            $table->boolean("active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_provider_storage');
    }
};
