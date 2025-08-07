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
        Schema::create('course', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('course_name');
            $table->string('course_tagline');
            $table->integer('course_fee');
            $table->integer('course_selling_fee');
            
            $table->string('course_slug');
            $table->string('course_duration');
            $table->string('course_level');

            $table->text('course_image');
            $table->longText('course_description');
            $table->boolean('course_status');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('course_category')
            ->onDelete('cascade');
            
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')
                ->references('id')
                ->on('instructor');

            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('course');
    }
};
