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
        Schema::create('mnt_user', function (Blueprint $table) {
            $table->id();
            $table->integer("id_people");
            $table->string("user_name", length: 150);
            $table->string("password", length: 150);
            $table->integer("id_status");
            $table->date("last_access");
            $table->boolean("is_validated");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_people")->references("id")->on("mnt_people");
            $table->foreign("id_status")->references("id")->on("ctl_status_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_user');
    }
};
