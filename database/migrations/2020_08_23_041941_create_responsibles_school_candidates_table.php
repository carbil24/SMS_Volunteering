<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsiblesSchoolCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsible_school_candidate', function (Blueprint $table) {
            $table->bigInteger('school_candidate_id')->unsigned()->index();
            $table->foreign('school_candidate_id')->references('id')->on('school_candidates');
            $table->bigInteger('responsible_id')->unsigned()->index();
            $table->foreign('responsible_id')->references('id')->on('responsibles');
            $table->string('relationship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsible_school_candidate');
    }
}
