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
        if (!Schema::hasTable('user_payment_methods')) {
            Schema::create('user_payment_methods', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('payment_type_id')->constrained()->onDelete('cascade');
                $table->string('provider');
                $table->string('account_number');
                $table->boolean('is_default')->default(0);
                $table->string('expiry_date')->default('Không có');
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
        Schema::dropIfExists('user_payment_methods');
    }
};
