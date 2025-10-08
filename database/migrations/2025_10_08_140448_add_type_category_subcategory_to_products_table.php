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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('stock');
            $table->foreign('type_id')->references('id')->on('product_types')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable()->after('type_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subcategory_id')->nullable()->after('category_id');
            $table->foreign('subcategory_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->dropForeign(['subcategory_id']);
            $table->dropColumn('subcategory_id');
        });
    }
};
