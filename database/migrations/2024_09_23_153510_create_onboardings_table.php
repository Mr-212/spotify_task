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
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('hear_about_us')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboardings');
    }
};
