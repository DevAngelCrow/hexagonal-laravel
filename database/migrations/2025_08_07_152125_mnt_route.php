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
        Schema::create('mnt_route', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("description", length: 255)->nullable();
            $table->string("icon", length: 150);
            $table->string("uri", length: 150);
            $table->boolean("active")->default(true);
            $table->boolean("show")->default(true);
            $table->integer("order")->nullable();
            $table->boolean("required_auth")->default(true);
            $table->string("title", length: 150);
            $table->integer("id_parent")->nullable();
            $table->foreign("id_parent")->references("id")->on("mnt_route");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_route');
    }
};
