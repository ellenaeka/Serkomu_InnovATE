<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emergency_reports', function (Blueprint $table) {
            $table->string('incident_type')->nullable();
            $table->string('location_category')->nullable();
            $table->string('detail_location')->nullable();
            $table->string('reporter_name')->nullable();
            $table->string('reporter_phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('emergency_reports', function (Blueprint $table) {
            $table->dropColumn([
                'incident_type',
                'location_category',
                'detail_location',
                'reporter_name',
                'reporter_phone',
            ]);
        });
    }
};
