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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->index(); // e.g., 'college-about', 'history'
            $table->string('section_key')->index(); // e.g., 'hero-title', 'hero-description'
            $table->longText('content'); // The actual editable content
            $table->unique(['page_slug', 'section_key']); // Ensure unique combinations
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
