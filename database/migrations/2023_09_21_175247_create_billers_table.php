<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->string('vname');
            $table->string('mode');
            $table->string('active_id', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billers');
    }
};
