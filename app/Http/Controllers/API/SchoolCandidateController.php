<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SchoolCandidate;


class SchoolCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchoolCandidate::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schoolCandidate = new SchoolCandidate();
        $schoolCandidate->nationalId = $request->nationalId;
        $schoolCandidate->typeOfAdmission = $request->typeOfAdmission;
        $schoolCandidate->firstName = $request->firstName;
        $schoolCandidate->lastName = $request->lastName;
        $schoolCandidate->middleName = $request->middleName;
        $schoolCandidate->dateOfBirth = $request->dateOfBirth;
        $schoolCandidate->gender = $request->gender;
        $schoolCandidate->nationality = $request->nationality;
        $schoolCandidate->countryOfBirth = $request->countryOfBirth;
        $schoolCandidate->regionOfBirth = $request->regionOfBirth;
        $schoolCandidate->cityOfBirth = $request->cityOfBirth;
        $schoolCandidate->countryOfResidency = $request->countryOfResidency;
        $schoolCandidate->regionOfResidency = $request->regionOfResidency;
        $schoolCandidate->cityOfResidency = $request->cityOfResidency;
        $schoolCandidate->address = $request->address;
        $schoolCandidate->postalCode = $request->postalCode;
        $schoolCandidate->situationOfParents = $request->situationOfParents;
        $schoolCandidate->situationOfTheChild = $request->situationOfTheChild;
        $schoolCandidate->picture = $request->picture;
        $schoolCandidate->responsibleA = $request->responsibleA;
        $schoolCandidate->responsibleB = $request->responsibleB;

        $schoolCandidate->save();

        return $schoolCandidate;    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolCandidate $schoolCandidate)
    {
        $schoolCandidate = SchoolCandidate::find($schoolCandidate->national_id);
        return $schoolCandidate;    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolCandidate $schoolCandidate)
    {
        $schoolCandidate = SchoolCandidate::find($schoolCandidate->id);
        $schoolCandidate->nationalId = $request->nationalId;
        $schoolCandidate->typeOfAdmission = $request->typeOfAdmission;
        $schoolCandidate->firstName = $request->firstName;
        $schoolCandidate->lastName = $request->lastName;
        $schoolCandidate->middleName = $request->middleName;
        $schoolCandidate->dateOfBirth = $request->dateOfBirth;
        $schoolCandidate->gender = $request->gender;
        $schoolCandidate->nationality = $request->nationality;
        $schoolCandidate->countryOfBirth = $request->countryOfBirth;
        $schoolCandidate->regionOfBirth = $request->regionOfBirth;
        $schoolCandidate->cityOfBirth = $request->cityOfBirth;
        $schoolCandidate->countryOfResidency = $request->countryOfResidency;
        $schoolCandidate->regionOfResidency = $request->regionOfResidency;
        $schoolCandidate->cityOfResidency = $request->cityOfResidency;
        $schoolCandidate->address = $request->address;
        $schoolCandidate->postalCode = $request->postalCode;
        $schoolCandidate->situationOfParents = $request->situationOfParents;
        $schoolCandidate->situationOfTheChild = $request->situationOfTheChild;
        $schoolCandidate->picture = $request->picture;
        $schoolCandidate->responsibleA = $request->responsibleA;
        $schoolCandidate->responsibleB = $request->responsibleB;
        $schoolCandidate->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolCandidate $schoolCandidate)
    {
        $schoolCandidate->delete();
    }
}
