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
        Schema::table('faculty_members', function (Blueprint $table) {
            // Advisor-specific fields
            $table->text('advisor_bio')->nullable()->after('biography');
            $table->integer('default_consultation_duration')->default(30)->after('advisor_bio');
            $table->integer('cancellation_deadline_hours')->default(24)->after('default_consultation_duration');
            $table->boolean('is_advisor_visible')->default(true)->after('cancellation_deadline_hours');
            $table->timestamp('profile_last_updated_at')->nullable()->after('is_advisor_visible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculty_members', function (Blueprint $table) {
            $table->dropColumn([
                'advisor_bio',
                'default_consultation_duration',
                'cancellation_deadline_hours',
                'is_advisor_visible',
                'profile_last_updated_at',
            ]);
        });
    }
};
