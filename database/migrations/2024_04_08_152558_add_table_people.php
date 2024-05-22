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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->text('comments');
            $table->timestamps();
        });

        // Insert a single row into the `people` table
        DB::table('people')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 1, // Assuming 1 for male, 0 for female, null for other
            'phone_number' => '1234567890',
            'email' => 'john.doe@example.com',
            'address_1' => '123 Main St',
            'address_2' => null,
            'city' => 'Anytown',
            'zip' => '12345',
            'country' => 'USA',
            'comments' => 'No comments',
            'created_at' => now(), // Use the `now()` helper to get the current datetime
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');

    }
};
