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
        Schema::create('mlmuser_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mlmuser_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('mlmuser_id')->references('id')->on('mlmusers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlmuser_products');
    }
};
