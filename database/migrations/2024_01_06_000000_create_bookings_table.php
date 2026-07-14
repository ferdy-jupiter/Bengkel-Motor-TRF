<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('layanan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mekanik_id')->nullable()->constrained('mekaniks')->nullOnDelete();
            $table->date('tanggal_servis');
            $table->time('jam_servis');
            $table->enum('status', ['pending', 'dikonfirmasi', 'dikerjakan', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
