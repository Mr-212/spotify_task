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
        Schema::create('spotify_artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('onboarding_id')->nullable();
            $table->string(column: 'spotify_id')->nullable();
            $table->string(column: 'url')->nullable();

            $table->string(column: 'name')->nullable();
            $table->string(column: 'genere')->nullable();
            $table->string(column:'popolarity')->nullable();
            $table->string(column:'followers')->nullable();

            $table->json('data')->nullable();
            $table->foreign('onboarding_id')->references('id')->on('onboardings')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spotify_artists');
    }
};
