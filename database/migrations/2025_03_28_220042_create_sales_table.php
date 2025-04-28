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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction');
            $table->string('type');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->decimal('subtotal', 64, 2);
            $table->decimal('discount', 64, 2)->nullable();
            $table->decimal('tax', 64, 2)->nullable();
            $table->decimal('final_total', 64, 2)->nullable();
            $table->unsignedBigInteger('promo_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('warehouses');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('cashier_id')->references('id')->on('cashiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
