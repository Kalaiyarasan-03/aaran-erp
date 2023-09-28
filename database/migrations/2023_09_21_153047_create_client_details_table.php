<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->references('id')->on('clients');

            $table->string('vname')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('gstin')->nullable();

            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();

            $table->string('gst_user')->nullable();
            $table->string('gst_pass')->nullable();

            $table->string('einvoice_user')->nullable();
            $table->string('einvoice_pass')->nullable();

            $table->string('eway_user')->nullable();
            $table->string('eway_pass')->nullable();

            $table->string('einvoice_api')->nullable();
            $table->string('einvoice_api_pass')->nullable();

            $table->string('eway_api')->nullable();
            $table->string('eway_api_pass')->nullable();

            $table->string('acc_email')->nullable();
            $table->string('acc_email_pass')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_details');
    }
};
