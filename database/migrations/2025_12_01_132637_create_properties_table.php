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
           Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->enum('type', ['sale', 'rent','invest']);
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->string('city');
            $table->string('address');
            $table->tinyInteger('bedrooms');
            $table->tinyInteger('bathrooms');
            $table->float('area');
            $table->foreignId('broker_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
