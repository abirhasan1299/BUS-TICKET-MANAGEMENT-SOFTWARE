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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('feedback_code');
            $table->string('overall_rating')->default(null);
            $table->string('cleanliness_rating')->default(null);
            $table->string('driver_rating')->default(null);
            $table->string('comfort_rating')->default(null);
            $table->string('punctuality_rating')->default(null);
            $table->string('comments')->default(null);
            $table->string('recommendation')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
