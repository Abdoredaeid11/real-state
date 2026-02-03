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
         Schema::create('property_types', function (Blueprint $table) {
            $table->id();               // المفتاح الأساسي
            $table->string('name');     // اسم النوع (مثلاً: شقة، فيلا)
            $table->timestamps();       // created_at و updated_at تلقائي
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_types');
    }
};
