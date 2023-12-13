<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ironings', function (Blueprint $table) {
            $table->id();
            $table->integer('vno');
            $table->date('vdate');
            $table->string('iron_master');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('style_id')->references('id')->on('styles');
            $table->decimal('total_qty',11,3);
            $table->string('receiver_details');
            $table->string('active_id', 3)->nullable();
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('ironing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ironing_id')->references('id')->on('ironings');
            $table->foreignId('jobcard_item_id')->references('id')->on('jobcard_items');
            $table->foreignId('section_inward_item_id')->references('id')->on('section_inward_items');
            $table->foreignId('colour_id')->references('id')->on('colours');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->decimal('qty',11,3);
            $table->string('active_id', 3)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ironing_items');
        Schema::dropIfExists('ironings');
    }
};
