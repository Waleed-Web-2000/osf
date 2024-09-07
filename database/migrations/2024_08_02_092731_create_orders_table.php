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
            $table->string('subtotal');
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->string('order_number')->unique();
            $table->string('product_name')->nullable();
            $table->string('product_img', 100)->nullable();
            $table->decimal('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('type')->default('home');
            $table->enum('mode',['cod','card','paypal'])->nullable();
            $table->string('buy_now')->nullable();
            $table->enum('status',['pending','delivered','canceled'])->default('pending');
            $table->boolean('is_shipping_different')->default(false);
            $table->date('delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
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
