<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->string('vname')->nullable();//display name
            $table->string('acno')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_id2')->nullable();
            $table->string('pks')->nullable();
            $table->string('trs')->nullable();
            $table->string('profileps')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('dvcatm')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_banks');
    }
};
