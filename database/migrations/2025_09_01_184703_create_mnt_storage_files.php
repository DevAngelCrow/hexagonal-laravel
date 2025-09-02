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
        Schema::create('mnt_storage_files', function (Blueprint $table) {
            $table->id();
            $table->string("filename", length: 150);
            $table->string("path", length: 500);
            $table->integer("id_provider");
            $table->bigInteger("size");
            $table->string("mime_type", length: 150);
            $table->integer("id_user");
            $table->boolean("active");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("id_provider")->references("id")->on("ctl_provider_storage");
            $table->foreign("id_user")->references("id")->on("mnt_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_storage_files');
    }
};
