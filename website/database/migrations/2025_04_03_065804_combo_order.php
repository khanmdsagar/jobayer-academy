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
        Schema::create('combo_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('combo_id');
            $table->date('order_date');
            
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combo_purchase')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('combo_order', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['combo_id']);
        });
        Schema::dropIfExists('combo_order');
    }
};
