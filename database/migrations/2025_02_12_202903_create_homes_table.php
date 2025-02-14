<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('experience')->nullable();
            $table->string('projects')->nullable();
            $table->string('clients')->nullable();
            $table->boolean('status')->default(0);

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
