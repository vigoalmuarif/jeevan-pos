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
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_category')->nullable();
            $table->decimal('amount_paid', 64, 2);
            $table->decimal('amount_balance', 64, 2);
            $table->string('payment_status');
            $table->string('ref');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_payments');
    }
};
