<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_orders', function (Blueprint $table) {
            $table->id();
            $table->string('university');
            $table->string('major');
            $table->string('type');
            $table->longText('description')->nullable();
            $table->string('deadline');
            $table->string('user_id')->nullable();
            $table->string('status')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        DB::statement('
            INSERT INTO new_orders (id, university, major, type, description, deadline, user_id, status)
            SELECT id, university, major, type, description, deadline, user_id, status
            FROM orders
        ');

        schema::drop('orders');
        Schema::rename('new_orders','order');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('orders');
    }
};
