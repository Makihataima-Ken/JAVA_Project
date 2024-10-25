<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('super_new_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');             // New column
            $table->string('usertype')->default('user'); // New column with default
            $table->string('phone')->unique();      // New unique column
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('
            INSERT INTO super_new_users (id, name, password, remember_token, created_at, updated_at)
            SELECT id, name, password, remember_token, created_at, updated_at
            FROM users
        ');
    // Step 3: Drop the old table
    Schema::drop('users');

    // Step 4: Rename the new table to 'users'
    Schema::rename('super_new_users', 'users');
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
    // Revert the changes if needed by dropping the new table and restoring the original
    Schema::dropIfExists('users');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('email_verified_at');
    }
};
