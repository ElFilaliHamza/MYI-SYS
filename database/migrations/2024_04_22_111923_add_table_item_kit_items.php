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
        Schema::create('item_kit_items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_kit_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('quantity', 15, 3);
            $table->integer('kit_sequence');
            $table->timestamps();

            // Clé primaire composite
            $table->primary(['item_kit_id', 'item_id', 'quantity']);

            // Clés étrangères
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('item_kit_id')->references('id')->on('item_kits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
