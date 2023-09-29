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
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->string('cutting_date');
            $table->string('cutting_master');
            $table->decimal('cutting_qty',11,3);
            $table->string('active_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('cutting_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('style_id')->references('id')->on('styles');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->foreignId('colour_id')->references('id')->on('colours');
            $table->decimal('qty',11,3);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutting_items');
        Schema::dropIfExists('cuttings');
    }
};
