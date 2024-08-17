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
        Schema::create('email_configs', function (Blueprint $table) {
            $table->id();
            $table->string('driver');
            $table->string('host');
            $table->integer('port');
            $table->string('encryption');
            $table->string('email_username');
            $table->string('email_password');
            $table->string('sendermail');
            $table->boolean('pretend')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_configs');
    }
};
