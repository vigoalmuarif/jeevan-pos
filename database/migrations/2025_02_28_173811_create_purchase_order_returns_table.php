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
        Schema::create('purchase_order_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_goods_receipt_id');
            $table->datetime('return_date');
            $table->text('return_reason');
            $table->decimal('total_return_value');
            $table->string('status');
            $table->timestamps();

            $table->foreign('purchase_order_goods_receipt_id')->references('id')->on('purchase_order_goods_receipts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_returns');
    }
};
