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
        Schema::create('index_dynamic_data', function (Blueprint $table) {
            $table->id();
            $table->string('mapping');
            $table->string('title')->nullable();
            $table->string('heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('button_name')->nullable();
            $table->string('button_url')->nullable();
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
        Schema::dropIfExists('index_dynamic_data');
    }
};
