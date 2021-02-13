<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uuid');
                $table->string('password');
                $table->string('username');
                $table->string('salt');
                $table->string('md5');
                $table->string('sha1');
                $table->string('sha256');
                $table->integer('customer_id')->unsigned();
                $table->timestamps();
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
