<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('author', 150);
            $table->text('intro');
            $table->text('content');
            $table->timestamp('published_at');
            $table->timestamps();//自动创建两个字段:created_at 和 update_at
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
        Schema::drop('articles');
    }
}
