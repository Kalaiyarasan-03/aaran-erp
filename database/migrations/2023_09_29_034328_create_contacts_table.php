<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('vname');
            $table->string('contact_person')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('landline')->nullable();
            $table->string('gstin')->nullable();
            $table->string('pan')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_area')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('pincode_id')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->unique(['vname', 'mobile']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
