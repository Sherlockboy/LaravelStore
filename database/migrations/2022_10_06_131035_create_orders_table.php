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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('address_id')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->string('full_name');
            $table->string('email');
            $table->string('status');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('zip');
            $table->string('phone');
            $table->float('final_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
