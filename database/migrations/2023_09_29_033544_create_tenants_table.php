<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('vname');
            $table->string('display_name')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->foreignId('state_id')->references('id')->on('states');
            $table->foreignId('pincode_id')->references('id')->on('pincodes');
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('landline')->nullable();
            $table->string('gstin')->nullable();
            $table->string('pan')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
