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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description")->nullable();
            $table->text("url")->nullable();
            $table->boolean("has_comments")->default(false);
            $table->boolean("has_reviews")->default(false);
            $table->boolean("new")->default(true);
            $table->integer("buy_price");
            $table->integer("sale_price");
            $table->string("code");
            $table->integer("quantity");
            $table->integer("vendor_id")->nullable();
            $table->foreignId("user_id")->constrained();
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
        Schema::dropIfExists('products');
    }
};
