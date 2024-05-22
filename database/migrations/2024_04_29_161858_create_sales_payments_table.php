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
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->string('payment_type', 40);
            $table->decimal('payment_amount', 15, 2);
            $table->decimal('cash_refund', 15, 2)->nullable()->default(0.00);
            $table->tinyInteger('cash_adjustment')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('payment_time')->useCurrent();
            $table->date('date_cheque')->nullable(); 
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_payments');
    }
};