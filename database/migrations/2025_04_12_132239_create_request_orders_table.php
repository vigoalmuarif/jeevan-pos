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
        Schema::create('request_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->unique();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('from_warehouse_id');
            $table->unsignedBigInteger('to_warehouse_id');
            $table->text('note')->nullable();
            $table->datetime('request_at');
            $table->unsignedBigInteger('request_by')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->datetime('sending_at')->nullable();
            $table->unsignedBigInteger('sending_by')->nullable();
            $table->datetime('received_at')->nullable();
            $table->unsignedBigInteger('recevied_by')->nullable();
            $table->integer('is_draft')->nullable();
            $table->string('filename')->nullable();
            $table->string('filepath')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('from_warehouse_id')->references('id')->on('warehouses');
            $table->foreign('to_warehouse_id')->references('id')->on('warehouses');
            $table->foreign('request_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('sending_by')->references('id')->on('users');
            $table->foreign('recevied_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_orders');
    }
};
