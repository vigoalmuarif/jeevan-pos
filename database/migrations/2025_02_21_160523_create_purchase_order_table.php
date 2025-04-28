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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('supplier_id');
            $table->foreignId('budget_category_id')->nullable();
            $table->string('po_number');
            $table->string('title');
            $table->string('desc')->nullable();
            $table->datetime('order_date');
            $table->string('estimated_delivery_day')->nullable();
            $table->datetime('expected_delivery_date')->nullable();
            $table->decimal('delivery_cost')->nullable();
            $table->decimal('total_price');
            $table->string('overall_discount_type')->nullable();
            $table->decimal('overall_discount_value')->nullable();
            $table->decimal('final_price');
            $table->string('status');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();


            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
