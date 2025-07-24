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
        Schema::create('mnt_document', function (Blueprint $table) {
            $table->id();
            $table->string("document_number");
            $table->integer("id_type_document");
            $table->integer("id_people");
            $table->string("description", length: 150);
            $table->boolean("state");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("id_type_document")->references("id")->on("ctl_type_document");
            $table->foreign("id_people")->references("id")->on("mnt_people");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_document');
    }
};
