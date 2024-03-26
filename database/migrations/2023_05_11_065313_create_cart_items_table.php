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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer("food_id")->unsigned();
            $table->string('food_name');
            $table->integer('food_price')->unsigned();
            $table->tinyInteger('food_discount')->unsigned();
            $table->tinyInteger('food_count')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
