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
        Schema::create('news_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['news', 'event', 'announcement']);
            $table->longText('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('event_date')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_events');
    }
};
