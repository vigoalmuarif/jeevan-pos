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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('business_type');
            $table->string('business_name');
            $table->string('corporate_name')->nullable();
            $table->string('address')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
            // $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
