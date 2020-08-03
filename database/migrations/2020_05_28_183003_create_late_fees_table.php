<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('late_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fee_id')->unsigned();
            $table->foreign('fee_id')->references('id')
                ->on('fees')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->decimal('l_fee', 10, 2)->default(0.00);
            $table->decimal('total_fee', 10, 2)->default(120.00);


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
        Schema::dropIfExists('late_fees');
    }
}
