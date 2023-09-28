<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_date')->nullable();
            $table->decimal('taxable');
            $table->decimal('gst');
            $table->decimal('amount');
            $table->decimal('receipt');
            $table->string('receipt_date')->nullable();
            $table->string('receipt_ref')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->string('status_id', 3);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_fees');
    }
};
