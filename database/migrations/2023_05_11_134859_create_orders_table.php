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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurants', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('order_status', ['checking','preparing','sending','delivered'])->default('checking');/*checking->preparing->sending->delivered */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
