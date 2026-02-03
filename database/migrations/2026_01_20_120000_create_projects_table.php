<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->enum('type', ['compound', 'property'])->default('compound');
            $table->string('developer')->nullable();
            $table->string('city')->nullable();
            $table->string('city_ar')->nullable();
            $table->string('location_text')->nullable();
            $table->decimal('starting_price', 15, 2)->nullable();
            $table->string('price_currency', 10)->nullable();
            $table->string('installments_up_to')->nullable();
            $table->unsignedInteger('min_bedrooms')->nullable();
            $table->unsignedInteger('max_bedrooms')->nullable();
            $table->unsignedInteger('delivery_year')->nullable();
            $table->string('main_image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ar')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->index(['type', 'status']);
            $table->index('city');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

