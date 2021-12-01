<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->date('date_of_application');
            $table->string('address');
            $table->string('title');
            $table->string('purpose_of_travel');
            $table->integer('no_of_vehicles');
            $table->string('from');
            $table->string('to');
            $table->string('valid_from');
            $table->string('valid_to');
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
        Schema::dropIfExists('data');
    }
}
