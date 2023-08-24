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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained();
            $table->string('heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('alt')->nullable();
            $table->string('cover_color')->nullable();
            $table->string('link')->nullable();
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('status')->default(0);
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
