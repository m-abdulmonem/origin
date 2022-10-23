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
            $table->string("code");
            $table->string("comments");
            $table->integer("quantity");
            $table->integer("buy_price");
            $table->integer("sale_price");
            $table->integer("discount");
            $table->enum("discount_type",['percentage','normal']);
            $table->enum("status",['pending','approved','shopping','shipped','delivered']);
            $table->foreignId("client_id")->constrained();
            $table->foreignId("product_id")->constrained();
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
