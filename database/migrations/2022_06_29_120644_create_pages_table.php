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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->text("title");
            $table->text("content")->nullable();
            $table->text("permalink")->nullable();
            $table->text("featured_image")->nullable();
            $table->text("password")->nullable();
            $table->integer("parent")->nullable();
            $table->enum("status",['public','draft','private','password'])->default('public');
            $table->timestamp('published_at')->nullable();
            $table->boolean('has_comments')->nullable();
            $table->boolean('is_reviewed')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->nullable()->constrained();
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
        Schema::dropIfExists('pages');
    }
};
