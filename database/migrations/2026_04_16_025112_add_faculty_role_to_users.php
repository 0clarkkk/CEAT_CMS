<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Note: The role column is currently VARCHAR so we don't need enum modifications
        // Faculty and Superadmin roles will be handled as string values
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
