<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments',function(Blueprint $table){
        $table->increments('id');
        $table->integer('parent_id');
            $table->integer('gra_parent_id')->nullable();
         $table->integer('article_id')->after('gra_parent_id');
        $table->string('name');
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
        Schema::drop('comments');
    }
}
