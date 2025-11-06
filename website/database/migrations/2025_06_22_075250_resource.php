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
        Schema::create('resource', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resource_name');
            $table->text('resource_path');
            $table->string('resource_type');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('course')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ask_question', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });
        Schema::dropIfExists('resource');
    }
};
