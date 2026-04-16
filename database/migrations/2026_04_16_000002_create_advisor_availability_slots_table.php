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
        Schema::create('advisor_availability_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advisor_id')->constrained('users')->onDelete('cascade');
            
            // Slot timing information
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            
            // Slot status
            $table->enum('status', ['available', 'booked', 'blocked'])->default('available');
            
            // Additional information
            $table->string('location')->nullable(); // Physical location for the consultation
            $table->text('notes')->nullable(); // Any special notes about the slot
            
            // System fields
            $table->timestamps();
            
            // Indexes for performance
            $table->index('advisor_id');
            $table->index('start_time');
            $table->index('end_time');
            $table->index('status');
            $table->index(['advisor_id', 'start_time']); // Composite index for finding availability
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisor_availability_slots');
    }
};
