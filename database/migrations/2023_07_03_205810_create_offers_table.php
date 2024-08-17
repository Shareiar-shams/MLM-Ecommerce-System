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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_for')->nullable();
            $table->string('offer_type')->nullable();
            $table->unsignedBigInteger('digital_product_id')->nullable();
            $table->string('offer_percentage')->nullable();
            $table->string('user_percentage')->nullable();
            $table->string('last_date')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();

            $table->foreign('digital_product_id')->references('id')->on('digital_products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
