<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdaPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mda_personnels', function (Blueprint $table) {
            $table->id();
            // $table->string('mda_entity');
            $table->foreignId('mda_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->string('vehicle_no');
            $table->string('nin');
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
        Schema::dropIfExists('mda_personnels');
    }
}
