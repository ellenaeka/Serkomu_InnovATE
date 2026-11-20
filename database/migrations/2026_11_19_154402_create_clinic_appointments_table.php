
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinic_appointments', function (Blueprint $table) {
            $table->id();

            // Menghubungkan pendaftaran dengan akun mahasiswa
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Data kunjungan klinik
            $table->string('poli');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('keluhan')->nullable();

            // Status pendaftaran
            $table->string('status')->default('Menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinic_appointments');
    }
};