<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\SurveyToken;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSurveyTokenRequest;
use App\Http\Requests\UpdateSurveyTokenRequest;

class SurveyTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
     {

     }
    //  public function addSurvey(){
    //     $token = Uuid::uuid4()->toString();
    //     $surveyToken = SurveyToken::create(['token' => $token]);
    //     return response()->json(['token' => $surveyToken->token], 201);
    //  }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurveyTokenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyToken $surveyToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyToken $surveyToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveyTokenRequest $request, SurveyToken $surveyToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyToken $surveyToken)
    {
        //
    }
}
