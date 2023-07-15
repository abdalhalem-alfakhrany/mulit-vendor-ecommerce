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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->decimal('offer_price')->nullable();

            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('image_id')->nullable()->constrained();

            $table->timestamps();
        });

        Schema::create('product_tag', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tag_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_tags');
        Schema::dropIfExists('products');
    }
};
