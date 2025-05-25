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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('user_nip');
            $table->enum('type', ['clock-in', 'clock-out']);
            $table->dateTime('waktu');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Durasi dihitung berdasarkan selisih dari expected time
            $table->decimal('late_duration', 5, 2)->nullable();     
            $table->decimal('overtime_duration', 5, 2)->nullable(); 

            $table->foreign('user_nip')->references('nip')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
