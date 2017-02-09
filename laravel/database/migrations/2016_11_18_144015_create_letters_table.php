<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('letters',function(Blueprint $table){
            $table->increments('id');
            $table->integer('mine_id');
            $table->integer('other_id');
            $table->string('name');
            $table->string('head_ico');
            $table->text('content');
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
        Schema::drop('letters');

    }
}
