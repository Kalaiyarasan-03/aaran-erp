<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_inwards', function (Blueprint $table) {
            $table->id();
            $table->integer('vno');
            $table->date('vdate');
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->foreignId('jobcard_id')->references('id')->on('jobcards');
            $table->string('contact_dc');
            $table->date('dc_date');
            $table->decimal('total_qty',11,3);
            $table->string('receiver_details');
            $table->string('active_id', 3)->nullable();
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('section_inward_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_inward_id')->references('id')->on('section_inwards');
            $table->foreignId('jobcard_item_id')->references('id')->on('jobcard_items');
            $table->foreignId('section_outward_item_id')->references('id')->on('section_outward_items');
            $table->foreignId('colour_id')->references('id')->on('colours');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->decimal('qty',11,3);
            $table->decimal('pending_qty',11,3);
            $table->string('active_id', 3)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_inward_items');
        Schema::dropIfExists('section_inwards');
    }
};
