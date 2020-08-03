<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('no action');
            //$table->string('student_name');


           // $table->integer('batch_id')->unsigned();
            //$table->foreign('batch_id')->references('id')
               // ->on('batch')
               // ->onDelete('no action')
              //  ->onUpdate('cascade');
            
            $table->decimal('fee', 10, 2);
            $table->string('description');
            //$table->decimal('ppts_fee', 10, 2)->default(120.00);
            //$table->decimal('reg_fee', 10, 2);
            //$table->decimal('sq_deposit', 10, 2)->default(0.00);
            //$table->double('scholarship')->nullable();
            //$table->integer('discount')->nullable();
            
            //$table->string('course_name');
            //$table->integer('installments')->default(0);
            //$table->integer('duration')->nullable();
            $table->date('fee_date');

            //$table->enum('installment', ['One Time', 'Monthly'])->default('One Time');
            //$table->decimal('late_fee')->default(0.00);
            //$table->decimal('ot_fee')->default(0.00);
            //$table->decimal('mt_fee')->default(0.00);
            //$table->integer('interval', 11)->default(30);


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
        Schema::dropIfExists('fees');
    }
}
