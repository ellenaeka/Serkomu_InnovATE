<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clinic_appointments', function (Blueprint $table) {
            $table->unsignedTinyInteger('queue_number')
                ->nullable()
                ->after('booking_code');

            $table->time('estimated_call_time')
                ->nullable()
                ->after('queue_number');

            $table->string('cancellation_reason')
                ->nullable()
                ->after('status');

            $table->unique(
                ['poli', 'tanggal', 'jam', 'queue_number'],
                'clinic_slot_queue_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('clinic_appointments', function (Blueprint $table) {
            $table->dropUnique('clinic_slot_queue_unique');

            $table->dropColumn([
                'queue_number',
                'estimated_call_time',
                'cancellation_reason',
            ]);
        });
    }
};
