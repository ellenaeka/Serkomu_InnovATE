<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'program_studi')) {
                $table->string('program_studi')->nullable();
            }

            if (!Schema::hasColumn('users', 'fakultas')) {
                $table->string('fakultas')->nullable();
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }

            if (!Schema::hasColumn('users', 'whatsapp')) {
                $table->string('whatsapp', 20)->nullable();
            }

            if (!Schema::hasColumn('users', 'auth_method')) {
                $table->string('auth_method')->default('manual');
            }

            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $columns = [
                'program_studi',
                'fakultas',
                'phone',
                'whatsapp',
                'auth_method',
                'profile_photo'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};