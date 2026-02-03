<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('address_ar');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('map_url', 2048)->nullable()->after('longitude');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'map_url']);
        });
    }
};

