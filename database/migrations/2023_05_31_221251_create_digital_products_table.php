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
        Schema::create('digital_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('short_description')->nullable();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('SKU');
            $table->string('featured_image');
            $table->string('gallery_image')->nullable();
            $table->double('price');
            $table->double('special_price')->nullable();
            $table->string('delivery_type');
            $table->string('delivery_entity');
            $table->string('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_products');
    }
};
