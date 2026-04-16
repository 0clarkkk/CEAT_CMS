<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create advisor role if it doesn't exist
        if (!Role::where('name', 'advisor')->exists()) {
            Role::create([
                'name' => 'advisor',
                'guard_name' => 'web',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove advisor role
        Role::where('name', 'advisor')->delete();
    }
};
