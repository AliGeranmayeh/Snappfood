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
        Schema::create('comment_food', function (Blueprint $table) {
            $table->foreignId('comment_id')->constrained('comments', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('food', 'id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_food');
    }
};
