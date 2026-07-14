<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mekaniks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_hp')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mekaniks');
    }
};
