<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SchoolStudentCandidate;


class SchoolStudentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchoolStudentCandidate::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schoolStudentCandidate = new SchoolStudentCandidate();
        $schoolStudentCandidate->nationalId = $request->nationalId;
        $schoolStudentCandidate->typeOfAdmission = $request->typeOfAdmission;
        $schoolStudentCandidate->firstName = $request->firstName;
        $schoolStudentCandidate->lastName = $request->lastName;
        $schoolStudentCandidate->middleName = $request->middleName;
        $schoolStudentCandidate->dateOfBirth = $request->dateOfBirth;
        $schoolStudentCandidate->gender = $request->gender;
        $schoolStudentCandidate->nationality = $request->nationality;
        $schoolStudentCandidate->countryOfBirth = $request->countryOfBirth;
        $schoolStudentCandidate->regionOfBirth = $request->regionOfBirth;
        $schoolStudentCandidate->cityOfBirth = $request->cityOfBirth;
        $schoolStudentCandidate->countryOfResidency = $request->countryOfResidency;
        $schoolStudentCandidate->regionOfResidency = $request->regionOfResidency;
        $schoolStudentCandidate->cityOfResidency = $request->cityOfResidency;
        $schoolStudentCandidate->address = $request->address;
        $schoolStudentCandidate->postalCode = $request->postalCode;
        $schoolStudentCandidate->situationOfParents = $request->situationOfParents;
        $schoolStudentCandidate->situationOfTheChild = $request->situationOfTheChild;
        $schoolStudentCandidate->picture = $request->picture;
        $schoolStudentCandidate->save();

        return $schoolStudentCandidate;    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolStudentCandidate $schoolStudentCandidate)
    {
        $schoolStudentCandidate = SchoolStudentCandidate::find($schoolStudentCandidate->national_id);
        return $schoolStudentCandidate;    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolStudentCandidate $schoolStudentCandidate)
    {
        $schoolStudentCandidate = SchoolStudentCandidate::find($schoolStudentCandidate->id);
        $schoolStudentCandidate->nationalId = $request->nationalId;
        $schoolStudentCandidate->typeOfAdmission = $request->typeOfAdmission;
        $schoolStudentCandidate->firstName = $request->firstName;
        $schoolStudentCandidate->lastName = $request->lastName;
        $schoolStudentCandidate->middleName = $request->middleName;
        $schoolStudentCandidate->dateOfBirth = $request->dateOfBirth;
        $schoolStudentCandidate->gender = $request->gender;
        $schoolStudentCandidate->nationality = $request->nationality;
        $schoolStudentCandidate->countryOfBirth = $request->countryOfBirth;
        $schoolStudentCandidate->regionOfBirth = $request->regionOfBirth;
        $schoolStudentCandidate->cityOfBirth = $request->cityOfBirth;
        $schoolStudentCandidate->countryOfResidency = $request->countryOfResidency;
        $schoolStudentCandidate->regionOfResidency = $request->regionOfResidency;
        $schoolStudentCandidate->cityOfResidency = $request->cityOfResidency;
        $schoolStudentCandidate->address = $request->address;
        $schoolStudentCandidate->postalCode = $request->postalCode;
        $schoolStudentCandidate->situationOfParents = $request->situationOfParents;
        $schoolStudentCandidate->situationOfTheChild = $request->situationOfTheChild;
        $schoolStudentCandidate->picture = $request->picture;
        $schoolStudentCandidate->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolStudentCandidate $schoolStudentCandidate)
    {
        $schoolStudentCandidate->delete();
    }
}
