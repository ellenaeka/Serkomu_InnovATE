<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Memeriksa apakah index sudah tersedia.
     */
    private function indexExists(string $indexName): bool
    {
        return DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'clinic_appointments')
            ->where('index_name', $indexName)
            ->exists();
    }

    public function up(): void
    {
        /*
         * 1. Buat tabel counter jika belum tersedia.
         */
        if (!Schema::hasTable('clinic_queue_counters')) {
            Schema::create('clinic_queue_counters', function (Blueprint $table) {
                $table->id();
                $table->date('tanggal');
                $table->string('poli', 100);
                $table->unsignedInteger('last_number')->default(0);
                $table->timestamps();

                $table->unique(
                    ['tanggal', 'poli'],
                    'clinic_queue_counter_unique'
                );
            });
        }

        /*
         * 2. Hapus index lama hanya jika memang masih ada.
         */
        if ($this->indexExists('clinic_slot_queue_unique')) {
            Schema::table('clinic_appointments', function (Blueprint $table) {
                $table->dropUnique('clinic_slot_queue_unique');
            });
        }

        /*
         * 3. Ambil seluruh kelompok tanggal dan poli.
         */
        $groups = DB::table('clinic_appointments')
            ->select('tanggal', 'poli')
            ->distinct()
            ->get();

        foreach ($groups as $group) {

            /*
             * Urutkan berdasarkan waktu pendaftaran.
             * Status dibatalkan tetap masuk perhitungan.
             */
            $appointments = DB::table('clinic_appointments')
                ->whereDate('tanggal', $group->tanggal)
                ->where('poli', $group->poli)
                ->orderBy('created_at')
                ->orderBy('id')
                ->get(['id']);

            $number = 0;

            foreach ($appointments as $appointment) {
                $number++;

                DB::table('clinic_appointments')
                    ->where('id', $appointment->id)
                    ->update([
                        'queue_number' => $number,
                    ]);
            }

            /*
             * 4. Simpan nomor terakhir.
             * Update jika counter sudah tersedia.
             */
            DB::table('clinic_queue_counters')->updateOrInsert(
                [
                    'tanggal' => $group->tanggal,
                    'poli' => $group->poli,
                ],
                [
                    'last_number' => $number,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        /*
         * 5. Buat unique index baru jika belum ada.
         */
        if (!$this->indexExists('clinic_daily_queue_unique')) {
            Schema::table('clinic_appointments', function (Blueprint $table) {
                $table->unique(
                    ['tanggal', 'poli', 'queue_number'],
                    'clinic_daily_queue_unique'
                );
            });
        }
    }

    public function down(): void
    {
        /*
         * Hapus index baru jika tersedia.
         */
        if ($this->indexExists('clinic_daily_queue_unique')) {
            Schema::table('clinic_appointments', function (Blueprint $table) {
                $table->dropUnique('clinic_daily_queue_unique');
            });
        }

        /*
         * Pulihkan index lama jika belum tersedia.
         */
        if (!$this->indexExists('clinic_slot_queue_unique')) {
            Schema::table('clinic_appointments', function (Blueprint $table) {
                $table->unique(
                    ['poli', 'tanggal', 'jam', 'queue_number'],
                    'clinic_slot_queue_unique'
                );
            });
        }

        Schema::dropIfExists('clinic_queue_counters');
    }
};
