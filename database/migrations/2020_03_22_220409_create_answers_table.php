<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquete_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('answer1');
            $table->string('answer2');
            $table->string('answer3');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('enquete_id')->references('id')->on('enquetes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
