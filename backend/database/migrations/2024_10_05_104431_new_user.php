<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Create a new table with the updated schema
        Schema::create('new_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');             // New column
            $table->string('usertype')->default('user'); // New column with default
            $table->string('phone')->unique();      // New unique column
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Step 2: Copy data from the old table to the new table
        DB::statement('
            INSERT INTO new_users (id, name, email_verified_at, password, remember_token, created_at, updated_at)
            SELECT id, name, email_verified_at, password, remember_token, created_at, updated_at
            FROM users
        ');

        // Step 3: Drop the old table
        Schema::drop('users');

        // Step 4: Rename the new table to 'users'
        Schema::rename('new_users', 'users');
    }

    public function down(): void
    {
        // Revert the changes if needed by dropping the new table and restoring the original
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }

};
