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
        // Schema::create('receivings_items', function (Blueprint $table) {
        //     $table->unsignedBigInteger('receiving_id');
        //     $table->unsignedBigInteger('item_id');
        //     $table->string('description')->nullable();
        //     $table->string('serialnumber')->nullable();
        //     $table->unsignedTinyInteger('line')->default(0); 
        //     $table->decimal('quantity_purchased', 15, 3)->default(0.000);
        //     $table->decimal('item_cost_price', 15, 2)->nullable();
        //     $table->decimal('item_unit_price', 15, 2)->nullable();
        //     $table->unsignedBigInteger('item_location');
        //     $table->decimal('receiving_quantity', 15, 3)->default(1.000);

        //     $table->primary(['item_id', 'line']);

        //     $table->bigInteger('receiving_id')->unsigned();

        //     $table->foreign('receiving_id')->references('id')->on('receivings')->onDelete('cascade');
        //     $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        //     $table->foreign('item_location')->references('id')->on('stock_location')->onDelete('cascade');

        // });

        Schema::create('receivings_items', function (Blueprint $table) {
            $table->unsignedBigInteger('receiving_id');
            $table->unsignedBigInteger('item_id');
            $table->string('description')->nullable();
            $table->string('serialnumber')->nullable();
            // $table->unsignedTinyInteger('line')->default(0); 
            $table->decimal('quantity_purchased', 15, 3)->default(0.000);
            $table->decimal('item_cost_price', 15, 2)->nullable();
            $table->decimal('item_unit_price', 15, 2)->nullable();
            $table->unsignedBigInteger('item_location');
            $table->decimal('receiving_quantity', 15, 3)->default(1.000);

            $table->timestamps();

            $table->primary(['receiving_id', 'item_id']);

            $table->foreign('receiving_id')->references('id')->on('receivings')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('item_location')->references('id')->on('stock_location')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivings_items');
    }
};