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
        Schema::create('researchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_center_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('specialization')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->json('research_interests')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('researchers');
    }
};
