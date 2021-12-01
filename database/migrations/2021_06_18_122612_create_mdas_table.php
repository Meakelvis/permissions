<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mdas', function (Blueprint $table) {
            $table->id();
            $table->string('entity')->nullable(true);
            $table->string('applicant_on_behalf');
            $table->string('title');
            $table->string('address');
            $table->string('category');
            $table->string('purpose');
            $table->string('phone');
            $table->string('no_of_workers');
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
        Schema::dropIfExists('mdas');
    }
}
