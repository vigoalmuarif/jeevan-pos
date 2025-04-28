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
        Schema::create('purchase_order_invoice_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_invoice_id');
            $table->string('tax_name');
            $table->decimal('tax_percentage');
            $table->decimal('tax_amount');
            $table->timestamps();


            $table->foreign('purchase_order_invoice_id')->references('id')->on('purchase_order_invoices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_invoice_taxes');
    }
};
