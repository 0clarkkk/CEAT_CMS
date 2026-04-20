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
        Schema::table('advisor_availability_slots', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false)->after('notes');
            $table->string('recurrence_pattern')->nullable()->after('is_recurring')->comment('daily, weekly, biweekly, monthly');
            $table->json('recurrence_days')->nullable()->after('recurrence_pattern')->comment('Days of week for weekly pattern: ["Monday", "Wednesday", "Friday"]');
            $table->integer('recurrence_end_weeks')->nullable()->after('recurrence_days')->comment('Number of weeks to generate recurring slots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advisor_availability_slots', function (Blueprint $table) {
            $table->dropColumn(['is_recurring', 'recurrence_pattern', 'recurrence_days', 'recurrence_end_weeks']);
        });
    }
};
