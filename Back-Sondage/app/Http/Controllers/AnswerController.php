<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Answer;
use App\Models\SurveyToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Affiche la liste des réponses.
     */
    public function allAnswer()
    {
        $answers = Answer::all();
        return response()->json([
            'message' => 'Liste des réponses récupérée avec succès',
            'data' => $answers
        ], 200);
    }

    /**
     * Ajoute une réponse à partir des données fournies dans la requête.
     */
    public function addAnswer(Request $request)
    {
        $answers = $request->input('answers');

        // Validation des données reçues
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*.answer' => 'required',
            'answers.*.questionId' => 'required',
        ]);

        // Si la validation échoue, renvoyer une réponse d'erreur avec les détails des erreurs
        if ($validator->fails()) {
            return response()->json(['erreur' => $validator->errors()], 405);
        }

        // Générer un token unique avec la librairie Ramsey\Uuid\Uuid
        $token = Uuid::uuid4()->toString();

        // Sauvegarder le token dans la table SurveyToken
        $surveyToken = new SurveyToken();
        $surveyToken->token = $token;
        $surveyToken->save();

        // Enregistrer les réponses associées au token dans la table Answer
        foreach ($answers as $answer) {
            Answer::create([
                'answer' => $answer['answer'],
                'question_id' => $answer['questionId'],
                'survey_token_id' => $surveyToken->id,
            ]);
        }

        // Renvoyer une réponse JSON pour indiquer que les réponses ont été créées avec succès
        return response()->json(['message' => 'Réponses créées', 'token' => $token], 201);
    }

    /**
     * Affiche les réponses associées à un token spécifié.
     */
    public function displayAnswers($token)
    {
        // Recherche du token dans la table SurveyToken
        $surveyToken = SurveyToken::where('token', $token)->first();

        // Si le token n'existe pas, renvoyer une réponse d'erreur
        if (!$surveyToken) {
            return response()->json(['erreur' => 'Token invalide'], 404);
        }

        // Récupérer les réponses associées au token depuis la table Answer
        $answers = Answer::where('survey_token_id', $surveyToken->id)->get();

        // Renvoyer les réponses sous forme de réponse JSON
        return response()->json(['answers' => $answers, 'created_at' => $surveyToken->created_at], 200);
    }

    /**
     * Récupère les réponses regroupées par token.
     */
    public function groupedAnswers()
    {
        // Récupérer les réponses avec leurs questions associées, regroupées par token
        $answers = Answer::with('question')->get()->groupBy('survey_token_id');

        // Renvoyer les réponses regroupées sous forme de réponse JSON
        return response()->json([
            'message' => 'Liste des réponses regroupées par surveytoken récupérée avec succès',
            'data' => $answers
        ], 200);
    }
}
