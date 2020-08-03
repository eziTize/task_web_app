<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->integer('tpo_id')->unsigned();
            $table->foreign('tpo_id')->references('id')
                ->on('tpo')
                ->onDelete('cascade')
                ->onUpdate('no action');


            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')
                ->on('admin')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')
                ->on('branch')
                ->onDelete('cascade')
                ->onUpdate('no action');


            $table->integer('telecaller_id')->unsigned();
            $table->foreign('telecaller_id')->references('id')
                ->on('telecaller')
                ->onDelete('cascade')
                ->onUpdate('no action');


            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')
                ->on('teacher')
                ->onDelete('cascade')
                ->onUpdate('no action');



            $table->string('description');



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
        Schema::dropIfExists('notifications');
    }
}
