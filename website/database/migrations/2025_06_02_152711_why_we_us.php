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
        Schema::create('why_we_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wwu_icon');
            $table->string('wwu_title');
            $table->string('wwu_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_we_us');
    }
};
