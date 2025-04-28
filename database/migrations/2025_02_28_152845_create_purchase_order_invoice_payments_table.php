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
        Schema::create('purchase_order_invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_invoice_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->decimal('payment_amount');
            $table->decimal('payment_amount_balance');
            $table->datetime('payment_date');
            $table->string('payment_status');
            $table->timestamps();

            $table->foreign('purchase_order_invoice_id')->references('id')->on('purchase_order_invoices');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_invoice_payments');
    }
};
