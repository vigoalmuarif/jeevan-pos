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
        Schema::create('request_order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_order_id');
            $table->string('delivery_number');
            $table->datetime('delivery_date')->nullable();
            $table->datetime('finish_date')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('user_delivery')->nullable();
            $table->string('status')->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();

            $table->foreign('request_order_id')->references('id')->on('request_orders');
            $table->foreign('user_delivery')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_order_deliveries');
    }
};
