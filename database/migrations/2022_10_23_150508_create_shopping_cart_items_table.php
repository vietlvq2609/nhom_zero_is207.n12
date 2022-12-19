<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shopping_cart_items')) {
            Schema::create('shopping_cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cart_id')->constrained('shopping_carts')->onDelete('cascade');
                $table->foreignId('product_item_id')->constrained('product_items')->onDelete('cascade');
                $table->tinyInteger('qty');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
