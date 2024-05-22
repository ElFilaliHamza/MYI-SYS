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
        Schema::create('cash_up', function (Blueprint $table) {
            $table->id();
            $table->timestamp('open_date')->useCurrent();
            $table->timestamp('close_date')->nullable();
            $table->decimal('open_amount_cash', 15, 2)->nullable();
            $table->decimal('transfer_amount_cash', 15, 2)->nullable();
            $table->integer('note')->nullable();
            $table->decimal('closed_amount_cash', 15, 2)->nullable();
            $table->decimal('closed_amount_card', 15, 2)->nullable();
            $table->decimal('closed_amount_check', 15, 2)->nullable();
            $table->decimal('closed_amount_total', 15, 2)->nullable();
            $table->string('description', 255)->nullable();
            $table->unsignedBigInteger('open_user_id')->nullable();
            $table->unsignedBigInteger('close_user_id')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->decimal('closed_amount_due', 15, 2)->nullable();


            $table->foreign('open_user_id')->references('id')->on('users');
            $table->foreign('close_user_id')->references('id')->on('users');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_up');
    }
};