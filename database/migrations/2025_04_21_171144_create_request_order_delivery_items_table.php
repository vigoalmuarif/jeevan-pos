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
        Schema::create('request_order_delivery_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_order_delivery_id');
            $table->unsignedBigInteger('request_order_item_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('qty_requested', 16, 5);
            $table->decimal('qty_delivered', 16, 5);
            $table->string('status', 20);
            $table->timestamps();

            $table->foreign('request_order_delivery_id')->references('id')->on('request_order_deliveries');
            $table->foreign('request_order_item_id')->references('id')->on('request_order_items');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_order_delivery_items');
    }
};
