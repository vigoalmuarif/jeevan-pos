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
        Schema::create('purchase_order_goods_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_goods_receipt_id');
            $table->unsignedBigInteger('purchase_order_item_id');
            $table->unsignedBigInteger('product_unit_id');
            $table->integer('ordered_qty')->default(0);
            $table->integer('received_qty')->default(0);
            $table->integer('damage_qty')->default(0);
            $table->integer('missing_qty')->default(0);
            $table->text('desc')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('purchase_order_goods_receipt_id')->references('id')->on('purchase_order_goods_receipts');
            $table->foreign('purchase_order_item_id')->references('id')->on('purchase_order_goods_receipt_items');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_goods_receipt_items');
    }
};
