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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_batch_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('product_unit_id');
            $table->unsignedBigInteger('product_unit_conversion_id')->nullable();
            $table->unsignedBigInteger('user_proccess_id');
            $table->decimal('qty');
            $table->string('movement_status');
            $table->string('desc');
            $table->string('reference_type');
            $table->unsignedBigInteger('reference_id');
            $table->timestamps();

            $table->foreign('stock_batch_id')->references('id')->on('stock_batches');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
            $table->foreign('product_unit_conversion_id')->references('id')->on('product_unit_conversions');
            $table->foreign('user_proccess_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
