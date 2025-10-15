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
            $table->string('sku')->unique();
            $table->string('affiliate_link')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('product_type');
            $table->json('tags')->nullable();
            $table->boolean('specifications')->default(false);
            $table->json('specification_data')->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('special_price', 10, 2)->nullable();
            $table->string('video_link')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->decimal('customize_charge', 10, 2)->nullable();
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
