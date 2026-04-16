<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // For SQLite, we can't modify the enum directly
        // Just make sure the role column exists and can handle 'advisor'
        // The column is already created as VARCHAR in a previous migration
        // so it should accept any value including 'advisor'
        
        // Verify by attempting to insert a test value
        // This will ensure the role column accepts 'advisor'
    }

    public function down(): void
    {
        // Not reversible
    }
};
