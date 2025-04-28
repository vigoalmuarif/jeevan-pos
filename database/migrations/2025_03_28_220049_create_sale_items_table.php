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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('product_price_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->decimal('qty', 12, 2);
            $table->decimal('cost_unit_price', 64, 2);
            $table->decimal('selling_unit_price', 64, 2);
            $table->decimal('discount_amount', 64, 2);
            $table->decimal('subtotal', 64, 2);
            $table->decimal('final_subtotal', 64, 2);
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('unit_id')->references('id')->on('product_units');
            $table->foreign('product_price_id')->references('id')->on('product_prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
