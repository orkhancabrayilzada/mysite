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
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->integer('age');
            $table->string('email');
            $table->string('occupation'); //meslek
            $table->string('nationality')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('image');
            $table->boolean('status')->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
