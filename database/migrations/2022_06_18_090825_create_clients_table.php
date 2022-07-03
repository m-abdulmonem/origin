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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('picture')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string("location")->nullable();
            $table->string("address1")->nullable();
            $table->string("address2")->nullable();
            $table->string("city")->nullable();
            $table->string("government")->nullable();
            $table->string("country")->nullable();
            $table->string("postal_code")->nullable();
            $table->string('lang')->default("ar");
            $table->string('api_token')->nullable();
            $table->enum('status',['pending','approved','blocked','active','not_verified']);
            $table->enum('provider',['password','facebook','google','twitter','instagram','phone']);
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
};
