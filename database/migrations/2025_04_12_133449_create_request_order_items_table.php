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
        Schema::create('request_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stock_batch_id')->nullable();
            $table->unsignedBigInteger('satuan_request_id');
            $table->decimal('qty_approved', 12 ,5)->default(0);
            $table->text('note')->nullable();
            $table->text('reject_reason')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('request_order_id')->references('id')->on('request_orders');
            $table->foreign('stock_batch_id')->references('id')->on('stock_batches');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('satuan_request_id')->references('id')->on('product_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_order_items');
    }
};
