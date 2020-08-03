<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mkt_id')->unsigned();
            $table->foreign('mkt_id')->references('id')
                ->on('marketing_person')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->string('sm_name');
            $table->date('date');
            $table->string('t_plan')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->decimal('expense', 10, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->integer('ph_no')->nullable();
            $table->integer('closure')->nullable();
            $table->string('type')->default('seminar');

            //$table->string('image')->nullable();

            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('seminars');
    }
}
