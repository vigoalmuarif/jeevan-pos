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
        Schema::create('purchase_order_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('goods_receipt_id');
            $table->string('invoice_number');
            $table->datetime('invoice_date');
            $table->datetime('due_date');
            $table->decimal('total_amount');
            $table->string('overall_discount_type');
            $table->decimal('overall_discount_value');
            $table->decimal('final_amount');
            $table->string('status');
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
            $table->foreign('goods_receipt_id')->references('id')->on('purchase_order_goods_receipts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_invoices');
    }
};
