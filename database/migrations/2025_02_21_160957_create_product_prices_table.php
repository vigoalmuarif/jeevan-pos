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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_unit_conversion_id');
            $table->unsignedBigInteger('product_unit_id');
            // $table->unsignedBigInteger('product_unit_conversion_id');
            $table->decimal('cost_price', 64, 2);
            $table->decimal('selling_price', 64, 2);
            $table->integer('sell_online')->default(1);
            $table->integer('status');
            $table->timestamps();


            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_unit_conversion_id')->references('id')->on('product_unit_conversions');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
            // $table->foreign('product_unit_conversion_id')->references('id')->on('product_unit_conversions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
