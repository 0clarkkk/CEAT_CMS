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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('short_name', 20);
            $table->string('slug')->unique();
            $table->enum('degree_level', ['bs', 'ms', 'mengg', 'de', 'phd', 'diploma']);
            $table->integer('duration_years');
            $table->longText('description')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('career_opportunities')->nullable();
            $table->json('curriculum_structure')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
