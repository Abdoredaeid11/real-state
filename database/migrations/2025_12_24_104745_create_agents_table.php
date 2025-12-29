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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Agent's full name
            $table->string('email')->unique()->nullable(); // optional
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable(); // path to profile picture
            $table->text('bio')->nullable(); // short description
            $table->json('social_links')->nullable();
            // Example: {"facebook":"url", "twitter":"url", "instagram":"url"}
            $table->enum('status', ['active','inactive'])->default('active'); // optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
