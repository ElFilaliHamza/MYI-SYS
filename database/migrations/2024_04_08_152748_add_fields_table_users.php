<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('hash_version')->default(2);
            $table->string('language')->nullable();
            $table->string('language_code')->nullable();
        });

        // Insert initial data into the `users` table
        DB::table('users')->insert([
            'name' => 'kamal hamidi',
            'email' => 'kamal@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('kamal123'), // Remember to hash the password
            'person_id' => 1, // Make sure this ID exists in your 'people' table
            'deleted' => 0,
            'hash_version' => 2,
            'language' => 'English',
            'language_code' => 'EN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('users');
    // }
};
