<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nationalId');
            $table->string('typeOfAdmission');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName')->nullable();
            $table->string('dateOfBirth');
            $table->string('gender');
            $table->string('nationality');
            $table->string('countryOfBirth');
            $table->string('regionOfBirth');
            $table->string('cityOfBirth');
            $table->string('countryOfResidency');
            $table->string('regionOfResidency');
            $table->string('cityOfResidency');
            $table->string('address');
            $table->string('postalCode')->nullable();
            $table->string('situationOfParents');
            $table->string('situationOfTheChild');
            $table->longText('picture')->nullable();
            $table->string('responsibleA')->nullable();
            $table->string('responsibleB')->nullable();
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
        Schema::dropIfExists('school_candidates');
    }
}
