<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_book_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_book_id')->references('id')->on('credit_books');
            $table->date('vdate');
            $table->string('purpose');
            $table->decimal('credit',11,2);
            $table->decimal('debit',11,2);
            $table->decimal('interest',11,2);
            $table->string('active_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_book_items');
    }
};
