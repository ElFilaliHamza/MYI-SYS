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
        Schema::create('item_kits', function (Blueprint $table) {
            $table->id();
            $table->string('item_kit_number')->nullable();
            $table->string('name');
            $table->decimal('kit_discount', 15, 2)->default(0.00);
            $table->String('kit_discount_type');
            $table->String('price_option');
            $table->String('print_option');
            $table->string('description')->nullable();
            $table->timestamps();

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
