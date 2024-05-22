<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('receivings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('receiving_time')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();;
            $table->unsignedBigInteger('user_id');
            $table->string('comment')->nullable();
            $table->string('payment_type', 20)->nullable();
            $table->string('reference', 32)->nullable();
            $table->string('receiving_type')->nullable(); 
            $table->Integer('stock_source')->nullable();
            $table->Integer('stock_destination')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('receivings');
    }
};