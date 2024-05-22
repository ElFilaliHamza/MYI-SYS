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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trans_items')->nullable();
            $table->unsignedBigInteger('trans_location')->nullable();
            $table->unsignedBigInteger('trans_user_id')->nullable();
            $table->timestamp('trans_date')->nullable(); 
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->foreign('trans_items')->references('id')->on('items');
            $table->foreign('trans_location')->references('id')->on('stock_location');
            $table->foreign('trans_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};