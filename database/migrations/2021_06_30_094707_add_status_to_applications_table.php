<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {

            $table->string('status')->default('pending');
            $table->date('date_of_approval')->nullable();
            $table->foreignId('users_id')->nullable()->constrained()->onDelete('cascade'); // approved/rejected by
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade'); // created by

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
}
