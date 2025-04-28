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
        Schema::create('purchase_order_return_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_goods_receipt_item_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->unsignedBigInteger('product_unit_id');
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->decimal('return_reason_item');
            $table->decimal('return_status_item');
            $table->timestamps();

            $table->foreign('purchase_order_goods_receipt_item_id')->references('id')->on('purchase_order_goods_receipt_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_return_items');
    }
};
