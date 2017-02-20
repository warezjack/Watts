<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBehavioursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behaviours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assessment_name');
            $table->boolean('has_emotions');
            $table->integer('emotion_id')->nullable()->unsigned();
            $table->boolean('has_categories');
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('emotion_id')->references('id')->on('emotions');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('behaviours');
    }
}
