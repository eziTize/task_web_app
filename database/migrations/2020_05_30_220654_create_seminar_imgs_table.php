<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminarImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seminar_id')->unsigned();
            $table->foreign('seminar_id')->references('id')
                ->on('seminars')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->string('img_type');
            $table->string('img_file');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seminar_imgs');
    }
}
