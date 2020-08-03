<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openings', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->integer('tpo_id')->unsigned();
            $table->foreign('tpo_id')->references('id')
                ->on('tpo')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->string('company_name');
            $table->string('company_details');
            $table->date('date');
            $table->string('o_type');
            $table->string('o_details')->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->string('intake_cap')->nullable();
            $table->integer('contact')->nullable();
            $table->integer('eligibility')->nullable();


            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('openings');
    }
}
