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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trans_items');
            $table->unsignedBigInteger('trans_user');
            $table->timestamp('trans_date')->useCurrent();
            $table->text('trans_comment');
            $table->unsignedBigInteger('trans_location')->nullable();
            $table->decimal('trans_inventory', 15, 3)->default(0.000);
            
            // Foreign key constraints
            $table->foreign('trans_items')->references('id')->on('items');
            $table->foreign('trans_user')->references('id')->on('users');
            $table->foreign('trans_location')->references('id')->on('stock_location');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
