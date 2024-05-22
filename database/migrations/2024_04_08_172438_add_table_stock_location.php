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
        Schema::create('stock_location', function (Blueprint $table) {
            $table->id();
            $table->string('location_name')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });

        // Insert initial data into the `stock_location` table
        DB::table('stock_location')->insert([
            'location_name' => 'Main Warehouse',
            'deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_location');
    }
};
