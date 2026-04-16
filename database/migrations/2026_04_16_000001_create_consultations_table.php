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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('advisor_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['academic', 'career', 'personal', 'technical', 'thesis', 'other']);
            $table->enum('status', ['pending', 'approved', 'rejected', 'scheduled', 'completed', 'cancelled'])->default('pending');
            $table->dateTime('scheduled_at')->nullable();
            $table->string('location');
            $table->text('notes')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->index('student_id');
            $table->index('advisor_id');
            $table->index('status');
            $table->index('scheduled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
