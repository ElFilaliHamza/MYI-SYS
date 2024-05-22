<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->string('company_name')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('account_number')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->string('category')->nullable();
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('people');
        });

        // Insert initial data into the `supplier` table
        DB::table('supplier')->insert([
            'person_id' => 1, // Ensure this ID exists in the `people` table
            'company_name' => 'Example Company',
            'agency_name' => 'Example Agency',
            'account_number' => '123456789',
            'deleted' => 0,
            'category' => 'Example Category',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};
