<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('applications',function(Blueprint $table){
            $table->increments('id');
            $table->integer('applicant_id');
            $table->string('applicant_name');
            $table->integer('activity_id');
            $table->text('apply_reason');
            $table->string('contact');
            $table->string('status')->default('申请中');
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
        Schema::drop('applications');
    }
}
