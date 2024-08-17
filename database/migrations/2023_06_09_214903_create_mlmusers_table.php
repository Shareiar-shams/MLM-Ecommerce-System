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
        Schema::create('mlmusers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('parent_id')->nullable();
            $table->string('refferer_id')->nullable();
            $table->string('invoice')->nullable();
            $table->string('reffer_code')->nullable();
            $table->string('activate_product')->nullable();
            $table->boolean('parent_activation')->nullable();
            $table->boolean('admin_activation')->nullable();
            $table->text('others_documents')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlmusers');
    }
};
