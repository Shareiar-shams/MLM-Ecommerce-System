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
        Schema::create('ordered_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_slug');
            $table->string('product_SKU');
            $table->string('product_attributes')->nullable();
            $table->string('product_attributes_value')->nullable();
            $table->float('product_refferer')->nullable();
            $table->text('customize_attribute')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_subcategory')->nullable();
            $table->integer('quantity')->unsigned();
            $table->timestamps();
            
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordered_items');
    }
};
