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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stock_batch_id')->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('product_unit_id');
            $table->string('adjusment_type');
            $table->decimal('qty', 64, 5);
            $table->decimal('stock_awal', 64, 5);
            $table->decimal('stock_akhir', 64, 5);
            $table->decimal('selisih', 64, 5);
            $table->string('reason')->nullable();
            $table->foreignId('adjustment_by');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('stock_batch_id')->references('id')->on('stock_batches');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
