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
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });

        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->foreignId('shopping_cart_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_shopping_cart');
        Schema::dropIfExists('shopping_carts');
    }
};
