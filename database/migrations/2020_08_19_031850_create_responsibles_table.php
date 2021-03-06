<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsibles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nationalId');
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
            $table->string('homePhone');
            $table->string('workPhone')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('responsibles');
    }
}
