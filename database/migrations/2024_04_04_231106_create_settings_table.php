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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('home_page_title')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('loader')->nullable();
            $table->boolean('display_loader')->default(false);
            $table->string('index_meta_keyword')->nullable();
            $table->text('index_meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
