<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('sale_time')->useCurrent();
            $table->unsignedBigInteger('customer_id');
            $table->text('comment')->nullable();
            $table->string('invoice_number')->unique();
            $table->string('quote_number')->nullable();
            $table->tinyInteger('sale_status')->default(0);
            $table->string('work_order_number')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('customer_id')->references('id')->on('customers');
        });

        // Insert initial data into the `sales` table
        DB::table('sales')->insert([
            'customer_id' => 1, // Ensure this ID exists in the `customers` table
            'comment' => 'Initial sale comment',
            'invoice_number' => 'INV001', // This must be unique
            'quote_number' => 'QUO001',
            'sale_status' => 0,
            'work_order_number' => 'WO001',
            'user_id' => 1, // Ensure this ID exists in the `users` table or set to NULL if it's nullable
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
