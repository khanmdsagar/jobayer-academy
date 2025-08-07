<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trxID');
            $table->string('amount');
            $table->string('paymentExecuteTime');
            $table->string('payerAccount');
            $table->string('statusMessage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_detail');
    }
};
