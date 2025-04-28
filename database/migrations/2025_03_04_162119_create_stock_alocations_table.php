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
        Schema::create('stock_alocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('product_unit_id');
            $table->integer('product_unit_conversion_id');
            $table->integer('minimal_stock')->default(0);
            $table->integer('maximal_stock')->default(0);
            $table->decimal('quantity_awal', 64, 10);
            $table->decimal('quantity', 64, 10);
            $table->boolean('status_proses')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('location_id')->references('id')->on('warehouses');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
            $table->foreign('product_unit_conversion_id')->references('id')->on('product_unit_conversions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_alocations');
    }
};
