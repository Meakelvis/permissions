<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidityToOrganisationPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisation_personnels', function (Blueprint $table) {
            $table->integer('validity')->default(14)->nullable(true);
            $table->date('date_of_approval')->nullable(true);
            $table->string('reason_for_rejection')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisation_personnels', function (Blueprint $table) {
            $table->dropColumn('validity');
            $table->dropColumn('date_of_approval');
            $table->dropColumn('reason_for_rejection');
        });
    }
}
