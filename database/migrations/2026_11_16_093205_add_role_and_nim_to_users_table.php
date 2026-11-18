<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Role pengguna: mahasiswa atau petugas
            $table->string('role')
                  ->default('mahasiswa')
                  ->index();

            // NIM hanya digunakan oleh mahasiswa
            $table->string('nim', 20)
                  ->nullable()
                  ->unique();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropUnique(['nim']);
            $table->dropIndex(['role']);

            $table->dropColumn(['role', 'nim']);

        });
    }
};
