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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('images')->nullable(); // Store multiple image paths as JSON
            $table->string('brochure')->nullable(); // PDF file path
            
            // Status checkboxes
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_ongoing')->default(false);
            
            $table->string('location')->nullable();
            
            // Features & Amenities (stored as JSON array)
            $table->json('features_amenities')->nullable();
            
            // Property Overview
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('sqft', 10, 2)->nullable();
            $table->integer('year_built')->nullable();
            $table->string('property_type')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
