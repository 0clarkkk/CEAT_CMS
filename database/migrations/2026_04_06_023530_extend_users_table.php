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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'admin', 'superadmin'])->default('student')->after('password');
            $table->string('student_id', 20)->nullable()->unique()->after('role');
            $table->foreignId('department_id')->nullable()->after('student_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true)->after('department_id');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'department_id')) {
                $table->dropForeign(['department_id']);
            }
            $table->dropColumn(['role', 'student_id', 'department_id', 'is_active', 'last_login_at']);
        });
    }
};
