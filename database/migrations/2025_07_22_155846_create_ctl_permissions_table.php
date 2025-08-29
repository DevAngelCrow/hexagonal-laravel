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
        Schema::create('ctl_permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 150);
            $table->string("description", length: 150);
            $table->integer("id_category_permissions");
            $table->timestamps();
            $table->softDeletes();
            $table->boolean("active")->default(true);
            $table->foreign("id_category_permissions")->references("id")->on("ctl_category_permissions");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctl_permissions');
    }
};
