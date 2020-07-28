<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquete_id')->unsigned()->index();
            $table->string('question_number');
            $table->string('min_select');
            $table->string('max_select');
            $table->string('choise1');
            $table->string('choise2');
            $table->string('choise3');
            $table->string('choise4');
            $table->string('choise5');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('enquete_id')->references('id')->on('enquetes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choises');
    }
}
