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
        Schema::create('model_media', function (Blueprint $table) {
            $table->id();
            $table->text("caption")->nullable();
            $table->string("model")->nullable();
            $table->integer("model_id")->nullable();
            $table->foreignId("media_id")->constrained();
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
        Schema::dropIfExists('model_media');
    }
};
