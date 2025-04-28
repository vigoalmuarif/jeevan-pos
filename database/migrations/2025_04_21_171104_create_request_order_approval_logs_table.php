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
        Schema::create('request_order_approval_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_order_id');
            $table->unsignedBigInteger('request_order_item_id');
            $table->decimal('qty_approved', 16, 5);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();   

            $table->foreign('request_order_id')->references('id')->on('request_orders');
            $table->foreign('request_order_item_id')->references('id')->on('request_order_items');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_order_approval_logs');
    }
};
