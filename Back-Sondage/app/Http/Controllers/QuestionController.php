<?php

namespace App\Http\Controllers;

use App\Models\Question;
// use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $questions = Question::all();
    return response()->json([
        'message' => 'Liste des questions récupérée avec succès',
        'data' => $questions
    ], 200);
}


    /**=     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    $question = new Question()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        //
      // Valider les données de la requête
      $validatedData = $request->validate([
        'title' => 'required|string',
        'body' => 'required',
        'type' => 'required|in:A,B,C',
        'choices' => 'nullable|json',
    ]);

    // Créer une nouvelle instance de la question
    $question = new Question();
    $question->title = $validatedData['title'];
    $question->body = $validatedData['body'];
    $question->type = $validatedData['type'];
    $question->choices = $validatedData['choices'];
    $question->save();

    // Retourner une réponse ou rediriger vers une autre page
    return response()->json(['message' => 'Question créée avec succès'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
