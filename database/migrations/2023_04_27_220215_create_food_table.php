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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('food_categories', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('discount_id')->nullable()->constrained('discounts', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->text('materials')->nullable();
            $table->bigInteger('price');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
