<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Answer;
use App\Models\SurveyToken;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
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
    public function createAnswer(Request $request, $question_id)
    {
        $validator = Validator::make($request->all(), [
            'answer' => 'required|array',
        ]);

        if ($validator->fails()) {
            // Les données de la requête sont invalides
            return response()->json(['error' => 'Invalid data'], 405);
        }

        $question = Question::find($question_id);
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $answer = new Answer;
        $answer->answer = $request->input('answer');
        $answer->question()->associate($question);
        $answer->save();

        return response()->json(['message' => 'Answer created'], 201);
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
