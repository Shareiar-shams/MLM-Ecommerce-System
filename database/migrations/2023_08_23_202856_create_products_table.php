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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('SKU')->unique();
            $table->string('affiliate_link')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('gallery_image')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description');
            $table->string('productType');
            $table->longText('tags')->nullable();
            $table->boolean('specifications')->default(false);
            $table->longText('specification_name')->nullable();
            $table->longText('specification_description')->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->double('price');
            $table->double('special_price')->nullable();
            $table->string('video_link')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->text('meta_descriptions')->nullable();
            $table->double('customize_charge')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
