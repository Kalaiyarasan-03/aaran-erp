<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuttings', function (Blueprint $table) {
            $table->id();
            $table->integer('vno');
            $table->date('vdate');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('jobcard_id')->references('id')->on('jobcards');
            $table->string('cutting_master');
            $table->decimal('total_qty',11,3);
            $table->string('active_id', 3)->nullable();
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('cutting_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cutting_id')->references('id')->on('cuttings');
            $table->foreignId('jobcard_item_id')->references('id')->on('jobcard_items');
            $table->foreignId('fabric_lot_id')->references('id')->on('fabric_lots');
            $table->foreignId('colour_id')->references('id')->on('colours');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->decimal('qty',11,3);
            $table->decimal('pending_qty',11,3);
            $table->string('active_id', 3)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutting_items');
        Schema::dropIfExists('cuttings');
    }
};
