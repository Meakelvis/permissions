<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->string('vehicle_no');
            $table->string('type_of_vehicle');
            $table->string('nin');
            $table->string('status')->default('pending');
            $table->string('phone_no');
            $table->foreignId('users_id')->nullable()->constrained()->onDelete('cascade'); // approved/rejected by
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
        Schema::dropIfExists('organisation_personnels');
    }
}
