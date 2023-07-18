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
        $answers = Answer::all();
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


    public function store()
    {
    }
    public function addAnswer(Request $request)
    {
        $answers = $request->input('answers');

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*.answer' => 'required',
            'answers.*.questionId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['erreur' => $validator->errors()], 405);
        }

        $token = Uuid::uuid4()->toString();
        $surveyToken = new SurveyToken();
        $surveyToken->token = $token;
        $surveyToken->save();

        foreach ($answers as $answer) {
            Answer::create([
                'answer' => $answer['answer'],
                'question_id' => $answer['questionId'],
                'survey_token_id' => $surveyToken->id,
            ]);
        }

        return response()->json(['message' => 'Réponses créées', 'token' => $token], 201);
    }

    public function displayAnswers($token)
{
    $surveyToken = SurveyToken::where('token', $token)->first();

    if (!$surveyToken) {
        return response()->json(['erreur' => 'Token invalide'], 404);
    }
    $answers = Answer::where('survey_token_id', $surveyToken->id)->get();

    return response()->json(['answers' => $answers, 'created_at' => $surveyToken->created_at,], 200);
}



public function groupedAnswers()
{
    $answers = Answer::with('question')->get()->groupBy('survey_token_id');

    return response()->json([
        'message' => 'Liste des réponses regroupées par surveytoken récupérée avec succès',
        'data' => $answers
    ], 200);
}



  // $tokens = SurveyToken::pluck('token')->all();
    // $groupedAnswers = [];

    // foreach ($tokens as $token) {
    //     $answers = Answer::where('survey_token_id', $token)->get();
    //     $groupedAnswers[$token] = $answers;
    // }




















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
