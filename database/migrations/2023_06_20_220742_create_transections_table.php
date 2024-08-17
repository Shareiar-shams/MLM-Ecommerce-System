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
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('mlmuser_id')->unsigned();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('digitalProdcut_id')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('paymentId')->nullable();
            $table->string('formable_type')->nullable();
            $table->string('formable_id')->nullable();
            $table->string('toable_type')->nullable();
            $table->string('toable_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('amount')->nullable();
            $table->string('transection_time')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mlmuser_id')->references('id')->on('mlmusers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('digitalProdcut_id')->references('id')->on('digital_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transections');
    }
};
