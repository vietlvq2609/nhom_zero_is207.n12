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
        if (!Schema::hasTable('shop_orders')) {
            Schema::create('shop_orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
                $table->foreignId('shipping_address')->constrained()->onDelete('cascade');
                $table->foreignId('shipping_method')->constrained()->onDelete('cascade');
                $table->foreignId('order_status')->constrained()->onDelete('cascade');
                $table->date('order_date');
                $table->integer('order_total');
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
        Schema::dropIfExists('shop_orders');
    }
};
