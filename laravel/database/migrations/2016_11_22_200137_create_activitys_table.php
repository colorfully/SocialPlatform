<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('activities',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->text('content');
            $table->string('cover')->nullable();
            $table->integer('num')->nullable();
            $table->string('Participants')->nullable();
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
        Schema::drop('activities');
    }
}
