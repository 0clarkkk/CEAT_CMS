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
            $table->boolean('is_advisor')->default(false)->after('is_active');
            $table->text('consultation_info')->nullable()->after('is_advisor');
            $table->string('office_location')->nullable()->after('consultation_info');
            $table->string('office_hours')->nullable()->after('office_location');
            $table->string('phone_number')->nullable()->after('office_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculty_members', function (Blueprint $table) {
            $table->dropColumn(['is_advisor', 'consultation_info', 'office_location', 'office_hours', 'phone_number']);
        });
    }
};
