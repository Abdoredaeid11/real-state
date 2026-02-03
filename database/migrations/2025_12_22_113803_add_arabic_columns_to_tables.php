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
        Schema::table('property_types', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->text('description_ar')->nullable()->after('description');
            $table->string('city_ar')->nullable()->after('city');
            $table->string('address_ar')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropColumn('name_ar');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'description_ar', 'city_ar', 'address_ar']);
        });
    }
};
