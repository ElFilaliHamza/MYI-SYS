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
        Schema::create('customer_packages', function (Blueprint $table) {
            $table->id(); 
            $table->string('package_name');
            $table->float('points_percent');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });

        // Insert initial data into the `packages` table
        DB::table('customer_packages')->insert([
            'package_name' => 'Basic Package',
            'points_percent' => 10.0,
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
        Schema::dropIfExists('customer_packages');
    }
};
