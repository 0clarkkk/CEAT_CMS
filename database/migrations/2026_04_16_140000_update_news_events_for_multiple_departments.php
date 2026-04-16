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
        // Add applies_to_all_departments column to news_events
        Schema::table('news_events', function (Blueprint $table) {
            $table->boolean('applies_to_all_departments')->default(false)->after('department_id');
        });

        // Create pivot table for news_events and departments (many-to-many)
        Schema::create('department_news_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_event_id')->constrained('news_events')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->timestamps();

            // Unique constraint to prevent duplicate associations
            $table->unique(['news_event_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropTable('department_news_event');
        Schema::table('news_events', function (Blueprint $table) {
            $table->dropColumn('applies_to_all_departments');
        });
    }
};
