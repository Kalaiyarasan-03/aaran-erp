<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobcards', function (Blueprint $table) {
            $table->id();
            $table->integer('vno');
            $table->date('vdate');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('style_id')->references('id')->on('styles');
            $table->string('total_qty');
            $table->string('active_id', 3)->nullable();
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('jobcard_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobcard_id')->references('id')->on('jobcards');
            $table->foreignId('fabric_lot_id')->references('id')->on('fabric_lots');
            $table->foreignId('colour_id')->references('id')->on('colours');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->decimal('qty',11,3);
            $table->decimal('cutting_qty',11,3);
            $table->decimal('pe_out_qty',11,3);
            $table->decimal('pe_in_qty',11,3);
            $table->decimal('se_out_qty',11,3);
            $table->decimal('se_in_qty',11,3);
            $table->string('active_id', 3)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobcard_items');
        Schema::dropIfExists('jobcards');
    }
};
