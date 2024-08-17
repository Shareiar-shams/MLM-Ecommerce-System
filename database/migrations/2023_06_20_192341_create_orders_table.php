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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_type')->nullable();
            $table->float('subtotal')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->float('total');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('digitalProdcut_id')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('invoice')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_town')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->text('shipping_data')->nullable();
            $table->text('coupon')->nullable();
            $table->string('shipping_title')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('order_comments')->nullable();
            $table->enum('order_status',['Default','Pending','Processing_Order','Delivery_in_progess','Received','Canceled'])->default('Default');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('digitalProdcut_id')->references('id')->on('digital_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
