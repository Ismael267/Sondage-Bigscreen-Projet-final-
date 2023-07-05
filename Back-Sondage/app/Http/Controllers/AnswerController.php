<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Answer;
use App\Models\SurveyToken;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreAnswerRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Question;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allAnswer()
    {
        //
        $answers=Answer::all();
        return response()->json([
            'message' => 'Liste des reponses récupérée avec succès',
            'data' => $answers
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(){

     }
     public function addAnswer(Request $request, $question_id)
     {
         $validator = Validator::make($request->all(), [
             'answer' => 'required|array',
             // 'answer.*' => 'required|string',
         ]);

         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 405);
         }

         $question = Question::find($question_id);

         $answers = [];
         $token = Uuid::uuid4()->toString();
         $surveyToken = SurveyToken::create(['token' => $token]);
         foreach ($request->input('answer') as $answerText) {
            $answer = new Answer();
            $answer->answer = $answerText;
            $answer->question()->associate($question);
            $answer->surveyToken()->associate($surveyToken);
            $answers[] = $answer;
        }

        foreach ($answers as $answer) {
            $answer->save();
        }

         return response()->json(['message' => 'Answers created', 'token' => $token], 201);
     }








    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
