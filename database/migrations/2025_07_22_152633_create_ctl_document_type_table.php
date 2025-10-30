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
        Schema::create('ctl_document_type', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->string("mask", length: 150);
            $table->boolean("active")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_document_type');
    }
};
