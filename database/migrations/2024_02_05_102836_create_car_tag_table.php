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
        Schema::create('car_tag', function (Blueprint $table) {
            //$table->id();
            $table->timestamps();
            $table->foreignId('tag_id')->references('id')->on('tags');
            $table->foreignId('car_id')->references('id')->on('cars');
            // Nullable: $table->integer('team_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_tag');
    }
};
