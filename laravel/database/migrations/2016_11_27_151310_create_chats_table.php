<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chats',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('head_ico');
            $table->string('content');
            $table->string('status')->default('0');
            $table->timestamp('create_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('chats');
    }
}
