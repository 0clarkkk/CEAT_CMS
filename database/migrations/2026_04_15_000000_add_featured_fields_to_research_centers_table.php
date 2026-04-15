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
        Schema::table('research_centers', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('contact_email');
            $table->integer('featured_order')->default(0)->after('is_featured');
            $table->string('featured_image')->nullable()->after('featured_order');
            $table->longText('featured_description')->nullable()->after('featured_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('research_centers', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'featured_order', 'featured_image', 'featured_description']);
        });
    }
};
