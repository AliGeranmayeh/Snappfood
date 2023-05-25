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
            $table->foreignId('restaurant_id')->constrained('restaurants', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cart_id')->constrained('carts', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->text('comment');
            $table->bigInteger('parent_id')->nullable();
            $table->integer('status'); //0=> waiting for confirmatio, 1=> confirmed, 2=> delete request
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
