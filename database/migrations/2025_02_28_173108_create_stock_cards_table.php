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
        Schema::create('stock_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('stock_batch_id')->nullable();
            $table->unsignedBigInteger('product_unit_id');
            $table->unsignedBigInteger('user_proccess_id');
            $table->string('movement_type'); //in out
            $table->decimal('qty_awal', 64, 2);
            $table->decimal('qty', 64, 2);
            $table->decimal('qty_akhir', 64, 2);
            $table->string('desc');
            $table->string('reference_type');
            $table->unsignedBigInteger('reference_id');
            $table->datetime('transaction_date');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('stock_batch_id')->references('id')->on('stock_batches');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
            $table->foreign('user_proccess_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_cards');
    }
};
