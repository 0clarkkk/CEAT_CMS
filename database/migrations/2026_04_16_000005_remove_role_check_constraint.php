<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite has already created the role column with a CHECK constraint
        // We need to recreate the table without the constraint to allow 'advisor'
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');

            // Create new table without the CHECK constraint
            DB::statement('
                CREATE TABLE users_temp (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name VARCHAR NOT NULL,
                    email VARCHAR NOT NULL,
                    email_verified_at DATETIME,
                    password VARCHAR NOT NULL,
                    remember_token VARCHAR,
                    created_at DATETIME,
                    updated_at DATETIME,
                    role VARCHAR NOT NULL DEFAULT \'student\',
                    student_id VARCHAR,
                    department_id INTEGER,
                    is_active TINYINT(1) NOT NULL DEFAULT \'1\',
                    last_login_at DATETIME,
                    UNIQUE(email),
                    FOREIGN KEY(department_id) REFERENCES departments(id) ON DELETE CASCADE
                )
            ');

            // Copy data
            DB::statement('
                INSERT INTO users_temp 
                SELECT id, name, email, email_verified_at, password, remember_token, created_at, 
                       updated_at, role, student_id, department_id, is_active, last_login_at
                FROM users
            ');

            // Drop old table
            DB::statement('DROP TABLE users');

            // Rename new table
            DB::statement('ALTER TABLE users_temp RENAME TO users');

            DB::statement('PRAGMA foreign_keys=ON');
        }
    }

    public function down(): void
    {
        // Not reversible
    }
};
