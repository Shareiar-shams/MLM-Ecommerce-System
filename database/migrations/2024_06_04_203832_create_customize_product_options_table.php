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
        Schema::create('customize_product_options', function (Blueprint $table) {
            $table->id(); // Laravel automatically creates an 'id' column as the primary key
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Foreign key constraint with cascade delete
            $table->string('option_type', 255);
            $table->string('option_name', 255);
            $table->string('option_value', 255)->unique();;
            $table->string('image', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customize_product_options');
    }
};
