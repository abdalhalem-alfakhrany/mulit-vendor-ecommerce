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
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });

        Schema::create('product_shopping_list', function (Blueprint $table) {
            $table->foreignId('shopping_list_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_shopping_list');
        Schema::dropIfExists('shopping_lists');
    }
};
