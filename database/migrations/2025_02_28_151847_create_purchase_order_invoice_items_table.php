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
        Schema::create('purchase_order_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('purchase_order_goods_receipt_id');
            $table->unsignedBigInteger('product_unit_id');
            $table->integer('qty');
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->string('discount_type');
            $table->decimal('discount_value');
            $table->decimal('final_price');
            $table->timestamps();


            $table->foreign('purchase_order_invoice_id')->references('id')->on('purchase_order_invoices');
            $table->foreign('purchase_order_goods_receipt_id')->references('id')->on('purchase_order_goods_receipts');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_unit_id')->references('id')->on('product_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_invoice_items');
    }
};
