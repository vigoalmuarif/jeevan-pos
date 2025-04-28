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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->unsignedBigInteger('base_warehouse_unit_id');
            $table->unsignedBigInteger('base_unit_id');
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->decimal('base_cost_price', 64);
            $table->decimal('base_selling_price', 64);
            $table->decimal('index');
            $table->integer('ppn')->nullable();
            $table->integer('pph')->nullable();
            $table->integer('sell_online')->default(1);
            $table->string('barcode')->nullable();
            $table->integer('start_stock')->default(0);
            $table->decimal('stock_awal_warehouse', 64)->default(0);
            $table->integer('min_stock')->default(0);
            $table->text('desc')->nullable();
            $table->string('profile_product_filename')->nullable();
            $table->string('profile_product_filepath')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('product_brand_id')->references('id')->on('product_brands');
            $table->foreign('base_warehouse_unit_id')->references('id')->on('product_units');
            $table->foreign('base_unit_id')->references('id')->on('product_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
