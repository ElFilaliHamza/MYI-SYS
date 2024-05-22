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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->useCurrent();
            $table->decimal('amount', 15, 2);
            $table->string('payment_type', 40);
            $table->unsignedBigInteger('expense_category_id');
            $table->string('description', 255);
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('deleted')->default(0);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();
            $table->foreign('expense_category_id')->references('id')->on('expense_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supplier_id')->references('id')->on('supplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
