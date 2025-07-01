<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->integer('price');
            $table->integer('quantity');
            $table->json('taxes');
            $table->integer('total');
            $table->integer('total_with_taxes');
            $table->foreignIdFor(App\Models\Cart::class);
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
