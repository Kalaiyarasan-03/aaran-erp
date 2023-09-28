<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gstfillings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->string('month');
            $table->string('year');
            $table->string('gstr1_arn')->nullable();
            $table->string('gstr1_date')->nullable();
            $table->string('gstr3b_arn')->nullable();
            $table->string('gstr3b_date')->nullable();
            $table->string('status_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gstfillings');
    }
};
