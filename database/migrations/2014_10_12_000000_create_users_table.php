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
        Schema::create('users', function (Blueprint $table) {
            $table->string('nip')->primary(); // Ganti ID dengan NIP
            $table->string('nama');
            $table->string('password');
            $table->string('departement')->nullable();
            $table->string('team_departement')->nullable();
            $table->string('manager_departement')->nullable();
            $table->enum('role', ['user', 'admin', 'super-admin'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
