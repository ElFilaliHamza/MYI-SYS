<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_number');
            $table->string('name');
            $table->string('category');
            $table->tinyInteger('item_type');
            $table->decimal('cost_price', 15, 2);
            $table->decimal('unit_price', 15, 2);
            $table->string('description');
            $table->string('pic_filename')->nullable();
            $table->string('stock_type')->default('inventaire');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
