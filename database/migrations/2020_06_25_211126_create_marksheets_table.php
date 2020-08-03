<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->string('course_name');
            $table->string('session');


            $table->string('semester');
            $table->string('msheet_no');
            $table->string('roll_no');

            $table->string('mtwe_fm');
            $table->string('mtwe_om');
            $table->string('tswe_fm');
            $table->string('tswe_om');

            $table->string('sp_fm');
            $table->string('sp_om');

            $table->string('viva_fm');
            $table->string('viva_om');


            $table->string('ft_fm');
            $table->string('ft_om');


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
        Schema::dropIfExists('marksheets');
    }
}
