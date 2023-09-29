<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('vname')->unique();
            $table->string('producttype')->nullable();
            $table->foreignId('hsncode_id')->references('id')->on('hsncodes');
            $table->string('unit')->nullable();
            $table->string('gstpercent')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
