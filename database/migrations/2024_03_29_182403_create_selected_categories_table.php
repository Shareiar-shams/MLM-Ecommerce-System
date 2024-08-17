<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('selected_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories');
            $table->foreignId('subcategory_id')->constrained('product_categories');
            // Add other columns if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_categories');
    }
};
