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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->string('company_name')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('points')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('package_id');
            $table->timestamps();


            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('package_id')->references('id')->on('customer_packages');
            $table->foreign('user_id')->references('id')->on('users');
        });
        
        // Insert initial data into the `customers` table
        DB::table('customers')->insert([
            'person_id' => 1, // Ensure this ID exists in the `people` table
            'company_name' => 'Initial Company',
            'account_number' => '1234567890',
            'points' => 100,
            'deleted' => 0,
            'user_id' => 1, // Ensure this ID exists in the `users` table
            'package_id' => 1, // Ensure this ID exists in the `customer_packages` table
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
