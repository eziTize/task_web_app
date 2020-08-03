<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningsStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openings_student', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('openings_id')->unsigned();
            $table->foreign('openings_id')->references('id')
                ->on('openings')
                ->onDelete('cascade')
                ->onUpdate('no action');
            
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->enum('selected', ['Yes', 'No', 'Pending'])->default('Pending');
            $table->enum('interviewed', ['Yes', 'No', 'Pending'])->default('Pending');
            $table->enum('result', ['Hired', 'Rejected', 'Pending'])->default('Pending');


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
        Schema::dropIfExists('openings_student');
    }
}
