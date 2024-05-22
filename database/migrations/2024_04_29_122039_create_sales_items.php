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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('item_id');
            $table->string('description')->nullable();
            $table->string('serialnumber')->nullable();
            $table->decimal('quantity_purchased', 15, 3)->default(0);
            $table->decimal('item_cost_price', 15, 2);
            $table->decimal('item_unit_price', 15, 2);
            $table->unsignedBigInteger('item_location');
            $table->timestamps();

            $table->primary(['sale_id', 'item_id']);

            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('item_location')->references('id')->on('stock_location')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};